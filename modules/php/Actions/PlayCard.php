<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Managers\Actions;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;

class PlayCard extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_PLAY_CARD;
  }

  public function getDescription()
  {
    $player = $this->getPlayer();
    $card = $this->getCard();
    return [
      'log' => clienttranslate('Play ${card_name}'),
      'args' => [
        'card_name' => $card->getName(),
        'i18n' => ['card_name'],
      ],
    ];
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
    }

    if (is_null($cardId)) {
      throw new \BgaVisibleSystemException('no card in args. Should not happen');
    }
    return Cards::getSingle($cardId);
  }

  protected $args = [
    'n' => 1,
    'free' => false,
  ];

  public function argsPlayCard()
  {
    $card = $this->getCard();
    $cId = $card->getId();
    $player = Players::getActive();
    if (!$this->getArg('free') && $card->canBePlayed($player)) {
      throw new \BgaVisibleSystemException('Card cannot be played. Should not happen');
    }

    $locations = [];
    $type = $card->getType();
    $subType = $card->getSubtype();
    if ($type == PERMANENT && !in_array(LANDMARK, $subType)) {
      $locations[$cId] = [PERMANENT];
    } elseif ($type == PERMANENT && in_array(LANDMARK, $subType)) {
      $locations[$cId] = [LANDMARK];
    } elseif ($type == SPELL) {
      $locations[$cId] = [LIMBO];
    } elseif ($type == CHARACTER) {
      $locations[$cId] = [STORM_LEFT, STORM_RIGHT];
    }

    return [
      'card_name' => $this->getCard()->getName(),
      'i18n' => ['card_name'],
      'cardId' => $cId,
      '_private' => ['active' => ['play' => $locations]],
      'descSuffix' => $this->getArg('free') ? 'free' : '',
    ];
  }

  public function actPlay($cardId, $location)
  {
    $args = $this->argsPlayCard()['_private']['active']['play'];
    $locations = $args[$cardId] ?? null;
    if (is_null($locations)) {
      throw new \BgaVisibleSystemException('This card cannot be played. Should not happen');
    }
    if (!in_array($location, $locations)) {
      throw new \BgaVisibleSystemException('Invalid location to play a card. Should not happen');
    }

    // $this->playCard($cardId, $location); // TODO
    Actions::get(CHOOSE_ASSIGNMENT)->playCard($cardId, $location);
    $this->resolveAction([$cardId, $location]);
  }
}
