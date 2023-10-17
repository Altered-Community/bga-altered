<?php
namespace ALT\Actions;
use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;

class Gain extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_GAIN;
  }

  public function getDescription()
  {
    $player = $this->getPlayer();
    $gain = $this->getGain();
    $desc = Utils::resourcesToStr([$gain[0] => $gain[1]], true);

    if ($player->getId() == Players::getActiveId()) {
      return [
        'log' => clienttranslate('Gain ${resources_desc}'),
        'args' => [
          'resources_desc' => $desc,
        ],
      ];
    }
    // The reward is for someone else
    else {
      return [
        'log' => clienttranslate('Let ${player_name} gain ${resources_desc}'),
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
    // list($resource, $amount) = $this->getGain();
    // return in_array($resource, [MONEY, XTOKEN]);
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

  public function getGain()
  {
    $args = $this->getCtxArgs();
    foreach ($args as $resource => $amount) {
      if (in_array($resource, ['cardId', 'pId', 'sourceId', 'source'])) {
        continue;
      }

      if (!in_array($resource, [BOOST, ANCHORED, FLEETING, GIGANTIC, ANCHORED])) {
        die('GAIN: unrecognized resource' . $resource);
      }

      return [$resource, $amount];
    }
    die('GAIN: resource not found' . $resource);
  }

  public function stGain()
  {
    $player = $this->getPlayer();
    $args = $this->getCtxArgs();
    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }
    $card = $this->getCard();

    // Increase resource and notify
    list($resource, $amount) = $this->getGain();
    $tokens = Meeples::createOnCard($resource, $card->getId(), $player->getId(), $amount);
    Notifications::gainToken($resource, $card, $tokens, false);
    Notifications::updateBiomes($card->getPlayer());

    $this->checkAfterListeners($player, ['gain' => $args]);
    $this->resolveAction();
  }
}
