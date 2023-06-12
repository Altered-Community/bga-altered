<?php
namespace ALT\States;
use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Core\Engine;
use ALT\Core\Stats;
use ALT\Helpers\Log;
use ALT\Managers\Players;
use ALT\Managers\Meeples;
use ALT\Managers\Cards;

trait TurnTrait
{
  function actOrderCards($cardIds)
  {
    $player = Players::getCurrent();
    foreach ($cardIds as $i => $cardId) {
      $card = Cards::getSingle($cardId);
      if (is_null($card) || $card->isPlayed() || $card->getPId() != $player->getId()) {
        throw new \BgaVisibleSystemException("You can't reorder that card:" . $card->getId());
      }

      Cards::setState($cardId, $i);
    }
  }

  /**
   * State function when starting a turn
   *  useful to intercept for some cards that happens at that moment
   */
  function stBeforeStartOfTurn()
  {
    if (Globals::isEndTriggered() && Globals::getEndRemainingPlayers() == []) {
      $this->endOfGameInit();
    } else {
      // if it happened in break, one more turn for all players
      Players::checkEndOfGame();
      $this->initCustomDefaultTurnOrder('labor', \ST_TURNACTION, ST_BREAK_MULTIACTIVE, true);
    }
  }

  /**
   * Activate next player
   */
  function stTurnAction()
  {
    $player = Players::getActive();
    self::giveExtraTime($player->getId());

    if (Globals::isEndTriggered() && Globals::getEndRemainingPlayers() == []) {
      $this->endOfGameInit();
      return;
    }

    Stats::incTurns($player);
    $node = [
      'childs' => [
        [
          'action' => CHOOSE_ACTION_CARD,
          'pId' => $player->getId(),
        ],
        [
          'action' => VENOM_PAY,
          'pId' => $player->getId(),
        ],
      ],
    ];

    // Inserting leaf Action card
    Engine::setup($node, ['method' => 'stEndOfTurn']);
    Engine::proceed();
  }

  /*******************************
   ********************************
   ********** END OF TURN *********
   ********************************
   *******************************/

  /**
   * End of turn : replenish and check break
   */
  function stEndOfTurn()
  {
    Globals::setUsedVenom(false);
    Globals::setVenomPaid(false);
    Globals::setVenomTriggered(false);
    Globals::setEffectMap4(false);
    $player = Players::getActive();

    // Solo mode: move one cube to the right
    if (Globals::isSolo()) {
      $this->stEndOfSoloTurn();
    }

    // Replenish pool of cards
    ZooCards::fillPool();
    Players::checkEndOfGamePlayer($player);

    if (Globals::isEndTriggered()) {
      $remaining = Globals::getEndRemainingPlayers();
      $remaining = array_diff($remaining, [$player->getId()]);
      Globals::setEndRemainingPlayers($remaining);
    }

    if (Globals::isMustBreak()) {
      Globals::setFirstPlayer(Players::getNextId(Players::getActiveId())); // for next start of order.
      Globals::setBreakPlayer(Players::getActiveId());
      Globals::setMustBreak(false);
      $this->endCustomOrder('labor');
    } elseif (Globals::isEndTriggered() && Globals::getEndRemainingPlayers() == []) {
      $this->endOfGameInit();
    } else {
      $this->nextPlayerCustomOrder('labor');
    }
  }

  function endOfGameInit()
  {
    if (Globals::getEndFinalScoringDone() !== true) {
      // Trigger discard state
      Engine::setup(
        [
          'action' => DISCARD_SCORING,
          'pId' => 'all',
          'args' => ['current' => Players::getActive()->getId()],
        ],
        ''
      );
      Engine::proceed();
    } else {
      // Goto scoring state
      $this->gamestate->jumpToState(\ST_PRE_END_OF_GAME);
    }
    return;
  }

  function stEndOfSoloTurn()
  {
    list($token, $mustBreak) = Meeples::endSoloTurn();
    Notifications::slideMeeples([$token]);
    Globals::setMustBreak($mustBreak);
    // Globals::setMustBreak(true);
  }

  function stPreEndOfGame()
  {
    foreach (Players::getAll() as $pId => $player) {
      foreach ($player->getPlayedCards(CARD_SPONSOR) as $cId => $card) {
        $card->score();
      }
      foreach ($player->getScoringHand() as $cId => $card) {
        $card->score();
      }

      // Make sure to call Players::get() because score was modified but it's cached in $player
      $score = Players::get($pId)->updateScore(true);
    }

    Log::clearUndoableStepNotifications(true);
    if (Globals::isSolo() && Globals::getSoloChallenge() > 0) {
      // new setup for solo challenge
      $this->setupNextGame();
    } else {
      Globals::setEnd(true);
      $this->gamestate->nextState('');
    }
  }

  /*
  function stLaunchEndOfGame()
  {
    foreach (ZooCards::getAllCardsWithMethod('EndOfGame') as $card) {
      $card->onEndOfGame();
    }
    Globals::setTurn(15);
    Globals::setLiveScoring(true);
    Scores::update(true);
    Notifications::seed(Globals::getGameSeed());
    $this->gamestate->jumpToState(\ST_END_GAME);
  }
  */
}
