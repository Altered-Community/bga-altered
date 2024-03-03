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

class TargetExpedition extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_TARGET_EXPEDITION;
  }


  public function argTargetExpedition()
  {
    $expeditions = [];
    foreach (Players::getAll() as $pId => $player) {
      foreach (STORMS as $storm) {
        $expeditions[] = $pId . '-' . $storm;
      }
    }
    return ['expeditions' => $expeditions];
  }

  public function stTargetExpedition()
  {
    if (($this->getCtxArg('expedition') ?? '') == 'all') {
      return ['all'];
    }
  }

  public function actTargetExpedition($expedition)
  {
    $player = $this->getPlayer();

    $expeditions = explode('-', $expedition);
    $pId = $expeditions[2];

    $node = $this->getArg('effect');
    $node['sourceId'] = $this->getSourceId();
    $node['args']['player'] = $pId;
    $node['args']['expedition'] = $expeditions[1];
    if (isset($node['childs'])) {
      foreach ($node['childs'] as &$child) {
        $child['sourceId'] = $this->getSourceId();
        $child['args']['player'] = $pId;
        $child['args']['expedition'] = $expeditions[1];
      }
    }

    $this->pushParallelChild($node);

    return [$expedition];
  }
}
