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
  function stPreEndOfGame()
  {
    // TODO remove in alpha
    if ($this->getBgaEnvironment() == 'studio') {
      // throw new \feException(print_r(debug_print_backtrace()));
      // throw new \feException('winner');
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
