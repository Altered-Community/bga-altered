<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Managers\ActionCards;
use ALT\Core\Engine;
use ALT\Core\Globals;
use ALT\Core\Stats;
use ALT\Helpers\Conditions;
use ALT\Helpers\Utils;
use ALT\Models\Player;

class UseCounter extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_USE_COUNTER;
  }

  public function getDescription()
  {
    if ($this->getArg('pay') != 0)
      return [
        'log' => clienttranslate('{${n}}'),
        'args' => [
          'n' => $this->getArg('pay'),
          'consume' => $this->getArg('consume')
        ],
      ];
    else {
      return '';
    }
  }

  protected $args = ['pay' => 0, 'consume' => 99];

  public function isDoable($player)
  {
    return $this->getArg('pay') <= $player->getMana();
  }


  public function stUseCounter()
  {
    $player = Players::getActive();
    $card = $this->getSource();
    $extraDatas = $card->getExtraDatas();
    $cost = $this->getArg('pay');
    $consume = $this->getArg('consume');
    if ($player->getMana() < $cost) {
      throw new \BgaVisibleSystemException('Cannot pay cost of use Counter. Should not happen');
    }

    if ($cost > 0) {
      $player->payMana($cost);
    }

    if (($extraDatas['counter'] ?? 0) < $consume) {
      throw new \BgaVisibleSystemException('Cannot consume counter. Should not happen');
    }

    $extraDatas['counter'] -= $consume;
    $card->setExtraDatas($extraDatas);

    Notifications::useCounter($player, $consume, $cost, $this->getSource());
    $this->resolveAction([$cost]);
  }
}
