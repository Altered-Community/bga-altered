<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
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
    return  clienttranslate('Move expedition');
  }

  public function isAutomatic($player = null)
  {
    return true;
  }


  protected $args = [
    'expedition' => null,
    'pId' => ME,
    'n' => 1
  ];

  public function stMoveExpedition()
  {
    $n = $this->getArg('n');
    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }

    $expedition = $this->getArg('expedition');

    if ($expedition === null) {
      throw new \BgaVisibleSystemException('an expedition is mandatory');
    }

    if ($expedition == EFFECT) {
      $expedition = $source->getLocation();
    }

    $token = $expedition == STORM_LEFT ? HERO : COMPANION;
    $getToken = 'get' . ucfirst($token) . 'Token';


    $pId = $this->getCtxArg('pId') ?? Players::getActiveId();
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

    $this->resolveAction(null);
  }
}
