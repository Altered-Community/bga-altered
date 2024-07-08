<?php

namespace ALT\States;

use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Core\Engine;
use ALT\Core\Stats;
use ALT\Core\Preferences;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Managers\Meeples;
use ALT\Helpers\Log;

trait NewDayTrait
{
  /****************** FIRST DAY*************/
  function stFirstDay()
  {
    $day = Globals::incDay(1);
    Stats::incDays();
    $nCards = 6;
    if (Globals::getTestingOption()) {
      $nCards = 15;
    }

    // Draw cards and make everyone active
    $pIds = [];

    // on new day, x cards are picked
    foreach (Players::getAll() as $pId => $player) {
      // put in specific location as they must be choosen
      $player->draw($nCards);
      $pIds[] = $pId;
    }

    Globals::setFirstDayManaSelection([]);
    $this->gamestate->setPlayersMultiactive($pIds, '', true);
    $this->gamestate->nextState('');
  }

  // Choose card(s) to put as mana
  function argsFirstDayManaSelection()
  {
    $selection = Globals::getFirstDayManaSelection();
    $args = [
      'canPass' => false,
      '_private' => [],
      'n' => Globals::getTestingOption() ? 10 : 3,
    ];

    foreach (Players::getAll() as $pId => $player) {
      $hand = $player->getHand();
      $args['_private'][$pId] = [
        'n' => Globals::getTestingOption() ? 10 : 3,
        'cards' => $hand->getIds(),
        'selection' => $selection[$pId] ?? null,
      ];
    }

    return $args;
  }

  public function actFirstDayManaSelection($cardIds)
  {
    self::checkAction('actFirstDayManaSelection');
    $player = Players::getCurrent();
    $args = $this->argsFirstDayManaSelection()['_private'][$player->getId()];

    if (count($cardIds) != $args['n']) {
      throw new \BgaUserException(clienttranslate('You must select the correct number of cards to put as mana'));
    }
    if (!empty(array_diff($cardIds, $args['cards']))) {
      throw new \BgaUserException('Invalid card to select. Should not happen');
    }

    $selection = Globals::getFirstDayManaSelection();
    $selection[$player->getId()] = $cardIds;
    Globals::setFirstDayManaSelection($selection);
    Notifications::updateFirstDayManaSelection($player, self::argsFirstDayManaSelection());

    $this->updateActivePlayersFirstDayManaSelection();
  }

  public function actCancelFirstDayManaSelection()
  {
    $this->gamestate->checkPossibleAction('actCancelFirstDayManaSelection');

    $player = Players::getCurrent();
    $selection = Globals::getFirstDayManaSelection();
    unset($selection[$player->getId()]);
    Globals::setFirstDayManaSelection($selection);
    Notifications::updateFirstDayManaSelection($player, self::argsFirstDayManaSelection());

    $this->updateActivePlayersFirstDayManaSelection();
  }

  public function updateActivePlayersFirstDayManaSelection()
  {
    // Compute players that still need to select their card
    // => use that instead of BGA framework feature because in some rare case a player
    //    might become inactive eventhough the selection failed (seen in Agricola and Rauha at least already)
    $selection = Globals::getFirstDayManaSelection();
    $players = Players::getAll();
    $ids = $players->getIds();
    $ids = array_diff($ids, array_keys($selection));

    // At least one player need to make a choice
    if (!empty($ids)) {
      $this->gamestate->setPlayersMultiactive($ids, 'done', true);
    }
    // Everyone is done => discard cards and proceed
    else {
      $selection = Globals::getFirstDayManaSelection();
      foreach ($players as $pId => $player) {
        $cardIds = $selection[$pId];
        if (empty($cardIds)) {
          continue;
        }

        Cards::discard($cardIds, MANA);
        $cards = Cards::getMany($cardIds);
        Notifications::discardMana($player, $cards, null, clienttranslate('${player_name} choses ${n} card(s) as mana'));
      }

      $this->checkCardListeners('Noon', ST_BEFORE_ASSIGNMENT);
    }
  }

  /*************************** NEW DAY**********************/

  // Clear previous stuff and draw new cards
  function stNewDay()
  {
    if (Players::checkVictory()) {
      return;
    }

    $day = Globals::incDay(1);
    $nCards = 0;
    Globals::setSkippedPlayers([]);
    Globals::setStormMoves([]);
    Globals::setNextCharacterBoost(0);
    Globals::setBlockedExpeditions([]);
    Cards::untapAll();
    Stats::incDays();
    Notifications::updateTotalMana();
    Globals::setPhase(0);
    Notifications::newPhase(PHASE_MORNING);

    // Change first player
    $currentFirstPId = Globals::getFirstPlayer();
    $newFirstPId = Players::getNextId($currentFirstPId);
    Globals::setFirstPlayer($newFirstPId);
    Notifications::newFirstPlayer(Players::get($newFirstPId));

    $reactions = [];

    foreach (Players::getAll() as $player) {
      if ($player->getHero()->getUid() == 'ALT_CORE_B_LY_03_C') {
        $player->draw(1, null, null, $player->getHero());
        $player->draw(
          1,
          null,
          MANA,
          $player->getHero(),
          clienttranslate('${player_name} draws 1 card from its deck and put it in mana (${card_name2}\'s effect)'),
          clienttranslate('You draw ${card_names} from your deck and put it in mana (${card_name2}\'s effect)')
        );
        $skipped[] = $player->getId();
        Globals::setSkippedPlayers($skipped);
      } else {
        $player->draw(2, null, null, null);
      }
    }

    // $this->initCustomDefaultTurnOrder('newDay', 'stNewDayDraw', 'stAfterNewday', true);
    $this->checkCardListeners('Morning', 'initNewDay');
  }

  public function initNewDay()
  {
    $this->initCustomDefaultTurnOrder('newDay', 'stNewDayDraw', 'stAfterNewday', true);
  }

  public function stNewDayDraw()
  {
    $player = Players::getActive();

    // check if a player skipped his turn
    $skipped = Globals::getSkippedPlayers();
    if (in_array($player->getId(), $skipped)) {
      // Everyone is out of round => end it
      $remaining = array_diff(Players::getAll()->getIds(), $skipped);
      if (empty($remaining)) {
        $this->endCustomOrder('newDay');
      } else {
        $this->nextPlayerCustomOrder('newDay');
      }
      return;
    }

    $skipped[] = $player->getId();
    Globals::setSkippedPlayers($skipped);
    self::giveExtraTime($player->getId());

    // Stats::incTurns($player);
    $node = [
      'pId' => $player->getId(),
      'action' => DISCARD,
      'args' => ['canPass' => true, 'n' => 1, 'source' => HAND, 'destination' => MANA],
    ];

    // Inserting leaf Action card
    Engine::setup($node, ['order' => 'newDay']);
    Engine::proceed();
  }

  // Trigger listeners linked to after the noon
  public function stAfterNewDay()
  {
    Globals::setPhase(1);
    Notifications::newPhase(PHASE_NOON);

    $this->checkCardListeners('Noon', ST_BEFORE_ASSIGNMENT);
  }
}
