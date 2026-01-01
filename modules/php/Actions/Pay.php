<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;

class Pay extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_PAY;
  }

  protected $args = [
    'X' => 1,
    'maximum' => INFTY
  ];

  public function getDescription()
  {
    $pay = $this->getCtxArg('pay') ?? 0;
    return [
      'log' => clienttranslate('Pay ${mana_cost}'),
      'args' => [
        'mana_cost' => $pay,
      ],
    ];
  }

  public function isDoable($player)
  {
    if ($this->getArg('pay') == 'X') {
      return true;
    }
    return $player->getMana() >= ($this->getCtxArg('pay') ?? 0);
  }

  public function isMandatory()
  {
    // we must do it to get the effect
    return true;
  }

  public function argsPay()
  {
    $player = Players::getActive();
    $pay = $this->getArg('pay') ?? 0;
    $maximum = $this->getArg('maximum');
    if (is_int($pay) && $pay > 0) {
      return [];
    }

    if ($maximum == 'exhaustedReserve' || $maximum == 'exhaustedReserveAndPermanent') {
      $exhausted = 0;
      foreach (Players::getAll() as $pId => $pp) {
        $exhausted += $pp->getReserveCards()->filter(function ($c) {
          return $c->isTapped();
        })->count();
      }

      if ($maximum == 'exhaustedReserveAndPermanent') {
        $exhausted += $player->getPlayedCards()->filter(function ($c) {
          return ($c->getType() == PERMANENT || in_array(PERMANENT, $c->getAdditionalType())) && $c->isTapped();
        })->count();
      }
      $maximum = $exhausted;
    }

    return [
      'pay' => $this->getCtxArg('pay'),
      'mana' => $player->getMana(),
      'maximum' => $maximum
    ];
  }

  public function stPay()
  {
    if (is_int($this->getCtxArg('pay')) && $this->getCtxArg('pay') > 0) {
      $this->actPay($this->getCtxArg('pay'));
    }
  }

  public function actPay($mana)
  {
    $player = $this->getPlayer();

    if ($mana > 0) {
      $player->payMana($mana);
      Notifications::pay($player, $mana);
    }

    $this->resolveAction([$mana]);
  }
}
