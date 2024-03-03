<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Core\Engine;

class MoveExpedition extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_MOVE_EXPEDITION;
  }

  public function getDescription()
  {
    return clienttranslate('Move expedition');
  }

  public function isAutomatic($player = null)
  {
    return count($this->getArg('expedition')) == 1;
  }

  protected $args = [
    'expedition' => [],
    'pId' => ME,
    'n' => 1,
  ];

  public function argsMoveExpedition()
  {
    $expeditions = $this->getArg('expedition');
    return [
      'expeditions' => empty($expeditions) ? STORMS : $expeditions,
      'actPId' => Players::getActive()->getId()
    ];
  }

  public function stMoveExpedition()
  {
    if (Globals::isTieBreakerMode()) {
      Notifications::message(clienttranslate('In tie-breaker this power has no effect.'), []);
      $this->resolveAction(null);
      return;
    }

    if (count($this->getArg('expedition')) == 1) {
      return [$this->getArg('expedition')[0], $this->getArg('pId')];
    }
  }

  public function actMoveExpedition($expedition, $pId)
  {
    $n = $this->getArg('n');
    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }

    if ($expedition === null) {
      throw new \BgaVisibleSystemException('an expedition is mandatory');
    }

    if ($expedition == EFFECT) {
      $expedition = $source->getLocation();
    }

    $token = $expedition == STORM_LEFT ? HERO : COMPANION;
    $getToken = 'get' . ucfirst($token) . 'Token';

    $pId = $pId ?? Players::getActiveId();
    if ($pId == ME) {
      $players = [Players::getActive()];
    } elseif ($pId == ALL) {
      $players = Players::getAll();
    } else {
      $players = [Players::getNext(Players::getActive())];
    }

    foreach ($players as $player) {
      $player->advanceStorm($token, null, $n, true, $source);
      $this->checkAfterListeners($player, ['moveExpedition' => $n]);
    }

    return [];
  }
}
