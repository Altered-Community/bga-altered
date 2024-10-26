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
    // $cards = Cards::getPlayedCards(null);
    // $gain = $this->getArg('type');
    // foreach ($cards as $cId => $card) {
    //   $block = $card->getBlockAutomaticAction();
    //   if (isset($block[GAIN]) && isset($block[GAIN][$gain])) {
    //     return false;
    //   }
    // }
    return true;
  }

  public function isIndependent($player = null)
  {
    // return false;
    $cards = Cards::getPlayedCards(null);
    $gain = $this->getArg('type');
    foreach ($cards as $cId => $card) {
      $block = $card->getBlockAutomaticAction();
      if (isset($block[GAIN]) && isset($block[GAIN][$gain])) {
        return false;
      }
    }
    return true;
  }

  public function getPlayer()
  {
    $pId = $this->getCtxArg('pId') ?? Players::getActiveId();
    return Players::get($pId);
  }

  public function getCard()
  {
    $cardId = $this->getCtxArg('cardId');
    if ($cardId == ME) {
      $cardId = $this->ctx->getSourceId() ?? null;
    } elseif ($cardId == EFFECT) {
      $cardId = $this->getCtx()->toArray()['event']['cardId'] ?? null;
    }

    if (is_null($cardId)) {
      throw new \BgaVisibleSystemException('no card in args (Gain). Should not happen');
    }
    return Cards::getSingle($cardId);
  }

  protected $args = [
    'n' => 1,
  ];

  public function getGain()
  {
    return [$this->getArg('type'), $this->getArg('n')];
  }

  public function gain($player, $card, $resource, $amount = 1, $source = null, $args = [])
  {
    $dynamicReplace = $card->getDynamicGainReplace();
    $args['cardId'] = $card->getId();

    if (is_null($source)) {
      $sourceId = -1;
    } else {
      $sourceId = $source->getId();
    }

    // Some effects change what is gained
    if (isset($dynamicReplace[$resource])) {
      $oldResource = $resource;
      $resource = $dynamicReplace[$resource];
      Notifications::message(
        clienttranslate('${old_resource} is replaced by ${resource} (${card_name}\'s effect)'),
        [
          'resource' => $resource,
          'old_resource' => $oldResource,
          'card' => $card,
          'i18n' => ['resource', 'old_resource'],
        ]
      );
      $args['type'] = $resource;
    }

    if (in_array($resource, [FLEETING, ANCHORED]) && $card->hasToken($resource)) {
      if ($card->isCanAlwaysGainFleeting()) {
        $this->checkAfterListeners($player, ['gain' => $args, 'sourceId' => $sourceId]);
      }
      // a card cannot have more than one fleeting/anchored token
      return;
    }

    $tokens = Meeples::createOnCard($resource, $card->getId(), $player->getId(), $amount);
    Notifications::gainMeeple($resource, $card, $tokens, $source, false);

    $this->checkAfterListeners($player, ['gain' => $args, 'sourceId' =>  $sourceId]);
  }

  public function stGain()
  {
    $player = $this->getPlayer();
    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }
    $card = $this->getCard();
    $args = $this->getCtxArgs();

    list($resource, $amount) = $this->getGain();

    $this->gain($player, $card, $resource, $amount, $source, $args);
    $this->resolveAction();
  }
}
