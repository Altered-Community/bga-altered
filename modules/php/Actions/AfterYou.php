<?php

namespace ALT\Actions;

use ALT\Managers\Players;
use ALT\Core\Notifications;
use ALT\Core\Globals;

class AfterYou extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_AFTER_YOU;
  }

  public function getDescription()
  {
    return clienttranslate('Wait next turn');
  }

  protected $args = ['pay' => 0, 'condition' => 'none'];

  public function isDoable($player)
  {
    return $player->getMana() >= $this->getCost($player);
  }

  private function getCost($player)
  {
    $pay = $this->getCtxArg('pay');
    $condition = $this->getCtxArg('condition');
    if ($pay == 0) {
      return $pay;
    }

    if ($condition == 'none') {
      return $pay;
    }

    if ($condition == 'notFirstPlayer' && Globals::getFirstPlayer() != $player->getId()) {
      return $pay;
    } elseif ($condition == 'notFirstPlayer' && Globals::getFirstPlayer() == $player->getId()) {
      return 0;
    }
  }

  public function stAfterYou()
  {
    $player = Players::getActive();
    $cost = $this->getCost($player);
    if ($player->getMana() < $cost) {
      throw new \BgaVisibleSystemException('Cannot pay cost of After You. Should not happen');
    }

    if ($cost > 0) {
      $player->payMana($cost);
    }

    Globals::incPlayedCards();
    Notifications::afterYou($player, $cost, $this->getSource());
    $this->resolveAction([$cost]);
  }
}
