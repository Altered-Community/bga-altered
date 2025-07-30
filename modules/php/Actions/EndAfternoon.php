<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Managers\Actions;

class EndAfternoon extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_END_AFTERNOON;
  }

  public function getDescription()
  {
    return [
      'log' => clienttranslate('End your Afternoon'),
      'args' => [],
    ];
  }

  public function isOptional($player)
  {
    return true;
  }

  public function stEndAfternoon()
  {
    Actions::get(CHOOSE_ASSIGNMENT)->actPass();
    $this->resolveAction();
  }
}
