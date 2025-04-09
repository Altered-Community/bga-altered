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
    $upTo = $this->getArg('upTo');

    if ($this->getArg('augment') == true) {
      return [
        'log' => clienttranslate('augment'),
        'args' => [],
      ];
    }

    if ($upTo == 99) {
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
    } else {
      if ($player->getId() == Players::getActiveId()) {
        return [
          'log' => clienttranslate('Gain ${resources_desc}  (up to ${upTo})'),
          'args' => [
            'resources_desc' => $desc,
            'upTo' => $upTo,
          ],
        ];
      }
      // The reward is for someone else
      else {
        return [
          'log' => clienttranslate('Let ${player_name} gain ${resources_desc} (up to ${upTo})'),
          'args' => [
            'player_name' => $player->getName(),
            'resources_desc' => $desc,
            'upTo' => $upTo
          ],
        ];
      }
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
    if ($this->getArg('augment')) {
      $gain = BOOST;
    } else {
      $gain = $this->getArg('type');
    }
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
    'augment' => false,
    'type' => '',
    'upTo' => 99
  ];

  public function getGain()
  {
    if ($this->getArg('augment') === true) {
      return ['augment', 1];
    }
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

    if (in_array($resource, [FLEETING, ASLEEP, ANCHORED]) && $card->hasToken($resource)) {
      if ($card->isCanAlwaysGainFleeting()) {
        $this->checkAfterListeners($player, ['gain' => $args, 'sourceId' => $sourceId]);
      }
      // a card cannot have more than one fleeting/anchored token
      return;
    }

    $tokens = Meeples::createOnCard($resource, $card->getId(), $player->getId(), $amount);
    Notifications::gainMeeple($resource, $card, $tokens, $source, false);

    $this->checkAfterListeners($player, ['gain' => $args, 'location' => $card->getLocation(), 'cardType' => $card->getType(), 'sourceId' =>  $sourceId]);
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
    $upTo = $this->getArg('upTo');

    list($resource, $amount) = $this->getGain();

    if ($resource == 'augment') {
      if ($card->countToken(BOOST) > 0) {
        $resource = BOOST;
      } else {
        // we need to increase the counter
        $data = $card->getExtraDatas();
        $data['counter'] = $data['counter'] + 1;
        $card->setExtraDatas($data);

        Notifications::gainCounter($card, 1);
        $this->checkAfterListeners($card->getPlayer(), ['specialEffect' => 'gainCounter']);
        $this->resolveAction([]);
        return;
      }
    }

    // check that we are not going to gain more than necessary
    $owned = $card->countToken($resource);
    if ($owned >= $upTo) {
      $this->resolveAction([]);
      return;
    } elseif (($owned + $amount) > $upTo) {
      $amount = $upTo - $owned;
    }


    $this->gain($player, $card, $resource, $amount, $source, $args);
    $this->resolveAction();
  }
}
