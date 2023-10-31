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

trait EndGameTrait
{
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

  function stPreEndOfGame()
  {
    // TODO remove in alpha
    if ($this->getBgaEnvironment() == 'studio') {
      throw new \feException('winner');
    }

    // TODO: API call
    $this->gamestate->nextState('');
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
