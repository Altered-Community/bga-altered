<?php
namespace ALT\Actions;
use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;

class Loose extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_LOOSE;
  }

  public function getDescription()
  {
    return [];
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
    $args = $this->getCtxArgs();
    $cardId = $args['cardId'] ?? null;
    if ($cardId === null) {
      throw new \BgaVisibleSystemException('no card in args. Should not happen');
    }
    return Cards::get($cardId);
  }

  public function getLoose()
  {
    $args = $this->getCtxArgs();
    foreach ($args as $resource => $amount) {
      if (in_array($resource, ['cardId', 'pId', 'sourceId', 'source'])) {
        continue;
      }

      if (!in_array($resource, [BOOST, ANCHORED, FLEETING, GIGANTIC, ANCHORED])) {
        die('LOOSE: unrecognized resource' . $resource);
      }

      return [$resource, $amount];
    }
    die('LOOSE: resource not found');
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
    $deleted = [];

    // Increase resource and notify
    list($resource, $amount) = $this->getLoose();
    $meeples = $card->getOfType($resource);

    foreach ($meeples as $mId => $m) {
      if ($amount == 0) {
        break;
      }
      Meeples::DB()->delete($mId);
      $deleted[] = $mId;
      $amount--;
    }

    if (count($deleted) > 0) {
      Notifications::looseToken($resource, $card, $deleted, false);
      Notifications::updateBiomes($card->getPlayer());
    }

    $this->checkAfterListeners($player, ['loose' => $args]);
    $this->resolveAction();
  }
}
