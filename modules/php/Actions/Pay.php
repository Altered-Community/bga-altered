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

  public function getDescription()
  {
    return '{T}';
  }

  public function isDoable($player)
  {
    return $player->getMana() >= ($this->getCtxArg('pay') ?? 0);
  }

  public function stPay()
  {
    $player = $this->getPlayer();

    $pay = $this->getCtxArg('pay') ?? 0;
    if ($pay > 0) {
      $player->payMana($pay);
      Notifications::pay($player, $pay);
    }

    $this->resolveAction();
  }
}
