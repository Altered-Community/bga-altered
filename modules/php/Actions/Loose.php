<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Collection;
use ALT\Helpers\Utils;

class Loose extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_LOOSE;
  }

  public function getDescription()
  {
    $player = $this->getPlayer();
    $gain = $this->getLoose();
    $desc = Utils::resourcesToStr([$gain[0] => $gain[1]], true);

    if ($player->getId() == Players::getActiveId()) {
      return [
        'log' => clienttranslate('loose ${resources_desc}'),
        'args' => [
          'resources_desc' => $desc,
        ],
      ];
    }
    // The reward is for someone else
    else {
      return [
        'log' => clienttranslate('Let ${player_name} loose ${resources_desc}'),
        'args' => [
          'player_name' => $player->getName(),
          'resources_desc' => $desc,
        ],
      ];
    }
  }

  public function isAutomatic($player = null)
  {
    return true;
  }

  public function isIndependent($player = null)
  {
    return true;
  }

  public function getPlayer()
  {
    $args = $this->getCtxArgs();
    $pId = $args['pId'] ?? Players::getActiveId();
    return Players::get($pId);
  }

  public function getCard()
  {
    $cardId = $this->getCtxArg('cardId');
    if ($cardId == ME) {
      $cardId = $this->ctx->getSourceId() ?? null;
    }

    if (is_null($cardId)) {
      throw new \BgaVisibleSystemException('no card in args (Loose). Should not happen');
    }
    return Cards::getSingle($cardId);
  }

  protected $args = [
    'n' => 1,
  ];

  public function getLoose()
  {
    return [$this->getArg('type'), $this->getArg('n')];
  }

  public function stLoose()
  {
    $player = $this->getPlayer();
    $args = $this->getCtxArgs();
    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }
    $card = $this->getCard();
    $deleted = new Collection();

    // Increase resource and notify
    list($resource, $amount) = $this->getLoose();
    $meeples = $card->getOfType($resource);

    foreach ($meeples as $mId => $m) {
      if ($amount == 0) {
        break;
      }
      $deleted[$mId] = $m;
      $amount--;
    }
    if (!empty($deleted)) {
      Meeples::delete($deleted->getIds());

      if (count($deleted) > 0) {
        Notifications::looseMeeples($resource, $card, $deleted, false);
      }

      $this->checkAfterListeners($player, ['loose' => $args]);
    }
    $this->resolveAction();
  }
}
