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
use ALT\Helpers\FT;
use ALT\Helpers\Utils;
use ALT\Models\Player;

class BlockExpedition extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_BLOCK_EXPEDITION;
  }

  public function getDescription()
  {
    return clienttranslate('Block an expedition');
  }

  public function argsBlockExpedition()
  {
    return [];
  }

  public function stBlockExpedition()
  {
    if (($this->getCtxArg('expedition') ?? '') == 'all') {
      return ['all'];
    }
  }

  public function actBlockExpedition($expedition)
  {
    $player = $this->getPlayer();

    if ($expedition == 'all' && ($this->getCtxArg('expedition') ?? '') != 'all') {
      throw new \BgaVisibleSystemException('Invalid expedition all. Should not happen');
    }

    if ($expedition == 'all') {
      $blocks = [];
      foreach (Players::getAll() as $pId => $player) {
        $blocks[$pId] = STORMS;
      }
      Globals::setBlockedExpeditions($blocks);
      Notifications::blockAllExpeditions(Players::getActive(), $this->getSource());
    } else {

      $expeditions = explode('-', $expedition);
      $blocked = Globals::getBlockedExpeditions();
      $block = [];
      if (isset($blocked[$expeditions[2]])) {
        $block = $blocked[$expeditions[2]];
      }
      $block[] = $expeditions[1];
      $blocked[$expeditions[2]] = $block;
      Globals::setBlockedExpeditions($blocked);
      Notifications::blockExpedition(Players::getActive(), Players::get($expeditions[2]), $expeditions[1]);
    }
    Notifications::updateBiomes(Players::getActive());

    return [$expedition];
  }
}
