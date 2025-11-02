<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Helpers\FT;
use ALT\Core\Engine;

class InteruptReveal extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_INTERRUPT_REVEAL;
  }

  public function getDescription()
  {
    return clienttranslate('Confirm display of card');
  }

  protected $args = [
    'create' => false,
    'regionType' => null
  ];

  public function argsMarkRegion()
  {

    return [];
  }


  public function actInteruptReveal()
  {
    $revelead = Cards::getInLocation(LIMBO);
    foreach ($revelead as $cId => &$card) {
      $card->setLocation(HAND);
      $player = $card->getPlayer();
    }
    Notifications::silentKill([], $revelead->getIds());
    Notifications::refreshHand($player, $player->getHand()->ui(), $player->getManaCards()->ui());
  }
}
