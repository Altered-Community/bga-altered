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

  protected $args = ['n' => 1];

  public function getDescription()
  {
    $msg = clienttranslate('Target ${n} expeditions to ${effect_desc}');
    return [
      'log' => $msg,
      'args' => [
        'n' => $this->getCtxArg('n') ?? 1,
        'effect_desc' => Engine::buildTree($this->getCtxArg('effect'))->getDescription(),
      ],
    ];
  }

  public function argsTargetExpedition()
  {
    $expeditions = [];
    $expeditionType = $this->getCtxArgs()['type'] ?? null;
    $winners = Players::getWinningPlayerByStorms();

    foreach (Players::getAll() as $pId => $player) {
      foreach (STORMS as $storm) {
        if ($expeditionType == 'ahead' && $winners[$storm] != $pId) {
          continue;
        }
        $expeditions[] = $pId . '-' . $storm;
      }
    }
    return ['expeditions' => $expeditions, 'n' => $this->getArg('n')];
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
    $args = $this->argsTargetExpedition();

    foreach ($expedition as $exp) {
      $expeditions = explode('-', $exp);
      if (!in_array($exp, $args['expeditions'])) {
        throw new \BgaVisibleSystemException('Invalid target expedition. Should not happen');
      }

      $pId = $expeditions[0];

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
    }


    return [$expedition];
  }
}
