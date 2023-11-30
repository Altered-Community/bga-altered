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
use ALT\Helpers\Utils;
use ALT\Models\Player;

class Discard extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_DISCARD;
  }

  public function isOptional()
  {
    return $this->getCtxArg('canPass') ?? false;
  }

  public function getDescription()
  {
    $location = $this->getCtxArg('destination') ?? 'discard';
    $msg = clienttranslate('discard to ${location} ${card}');
    if ($location == 'discard') {
      $msg = clienttranslate('discard ${card}');
    }

    if (!is_null($this->getCtxArg('cardId') ?? null)) {
      $card = Cards::get($this->getCtxArg('cardId'));
    } else {
      $card = '';
    }

    return [
      'log' => $msg,
      'args' => ['location' => $this->getCtxArg('destination') ?? 'discard', 'card' => $card != '' ? $card->getName() : ''],
    ];
  }

  public function stDiscard()
  {
    if (!is_null($this->getCtxArg('cardId') ?? null)) {
      $this->actDiscard([$this->getCtxArg('cardId')], true);
    }
    if (!is_null($this->getCtxArg('n') ?? null) && $this->getCtxArg('n') == ME) {
      $this->actDiscard([$this->getCtx()->getSourceId()], true);
    }
  }

  protected $args = [
    'upTo' => false, // if n > 1, can the player select UP TO n cards or exactly n cards ?
    'destination' => 'discard',
    'n' => 1, // number of card to discard
    'source' => '',
    'nLandmarks' => 0, // only for night clean up
    // 'totalCost' => INFTY
  ];

  public function argsDiscard()
  {
    $player = Players::getActive();
    if (($this->getCtxArg('special') ?? '') == 'nightCleanUp') {
      return [
        'n' => $this->getArg('n') ?? 1,
        'nLandmarks' => $this->getArg('nLandmarks'),
        'source' => $this->getArg('source') ?? '',
        'destination' => $this->getArg('destination'),
        'descSuffix' => 'nightCleanUp',
        'upTo' => false,
        '_private' => [
          'active' => [
            'reserveCards' => $player->getReserveCards()->getIds(),
            'landmarkCards' => $player->getLandmarks()->getIds(),
            'cards' => $player
              ->getReserveCards()
              ->merge($player->getLandmarks())
              ->getIds(),
          ],
        ],
      ];
    } elseif (!is_null($this->getCtxArg('cardId'))) {
      $cards = [];
    } elseif ($this->getArg('source') == HAND) {
      $cards = $player->getHand()->getIds();
    } elseif ($this->getArg('source') == RESERVE) {
      $cards = $player->getReserveCards()->getIds();
    } else {
      $cards = $player->getPlayedCards()->getIds();
    }
    return [
      'n' => $this->getArg('n') ?? 1,
      'source' => $this->getArg('source') ?? '',
      'destination' => $this->getArg('destination'),
      'descSuffix' => $this->isOptional() ? 'CanPass' : '',
      'upTo' => $this->getArg('upTo'),
      // 'totalCost' => $this->getArg('totalCost'),
      '_private' => [
        'active' => [
          'cards' => $cards,
        ],
      ],
    ];
  }

  public function actDiscard($cardIds, $automatic = false)
  {
    $player = Players::getActive();
    $args = $this->argsDiscard();
    $hand = false;
    // $totalCost = $this->getArg('totalCost');

    if ($automatic === false) {
      // self::checkAction('actDiscard');

      if (
        ($args['upTo'] == false && count($cardIds) != $args['n'] + ($args['nLandmarks'] ?? 0)) ||
        ($args['upTo'] == false && count($cardIds) > $args['n'] + ($args['nLandmarks'] ?? 0))
      ) {
        throw new \BgaVisibleSystemException('You must select the correct number of cards. Should not happen');
      }

      if (
        !empty(array_diff($cardIds, $args['_private']['active']['cards'] ?? [])) &&
        !empty(array_diff(
          $cardIds,
          array_merge($args['_private']['active']['reserveCards'] ?? [], $args['_private']['active']['landmarkCards'] ?? [])
        ))
      ) {
        throw new \BgaVisibleSystemException('You selected a card that should not be discarded. Should not happen');
      }

      // check correct number of cards taken
      if ($args['descSuffix'] == 'nightCleanUp') {
        if (
          count($cardIds) - count(array_diff($cardIds, $args['_private']['active']['reserveCards'])) != $args['n'] ||
          count($cardIds) - count(array_diff($cardIds, $args['_private']['active']['landmarkCards'])) != $args['nLandmarks']
        ) {
          throw new \BgaVisibleSystemException('You must select the correct number of each type of cards');
        }
      }
    }

    foreach ($cardIds as $cardId) {
      $card = Cards::get($cardId);
      $card->checkLeaveExpeditionListener();
      // $totalCost += $card->getCostHand();
      if ($card->getLocation() == HAND) {
        $hand = true;
      }
    }

    Cards::discard($cardIds, $args['destination']);

    $cards = Cards::getMany($cardIds);

    $deleted = [];
    foreach ($cards as $cardId => $card) {
      // we discard a card that has fleeting and should go to reserve
      if ($args['destination'] == RESERVE && $card->hasToken(FLEETING)) {
        Cards::discard($cardId);
      }
      // remove all meeples on the card
      // TODO : manage seasoned
      $deleted = array_merge($deleted, Meeples::getInLocation('card-' . $cardId)->getIds());
      Meeples::delete(Meeples::getInLocation('card-' . $cardId)->getIds());
    }

    $msg = clienttranslate('${player_name} discards ${n} card(s) from the ${source}');
    if ($args['destination'] == HAND) {
      $msg = clienttranslate('${player_name} puts ${n} card(s) to players\' hand');
    } elseif ($args['destination'] == 'discard') {
      $msg = clienttranslate('${player_name} discards ${card_names} (${n} card(s))');
    } elseif ($automatic === true) {
      $msg = clienttranslate('${player_name} discards ${n} card(s)');
    }

    // deleting meeples first
    if (!empty($deleted)) {
      Notifications::silentKill($deleted);
    }

    if ($args['destination'] == HAND) {
      Notifications::moveToHand($player, $cards, $msg, null, [
        'source' => $args['source'],
        'destination' => $args['destination'],
      ]);
    } elseif ($args['destination'] == MANA) {
      Notifications::discardMana($player, $cards, null, clienttranslate('${player_name} choses ${n} card(s) as mana'));
    } else {
      Notifications::publicDiscard($player, $cards, $msg, [
        'source' => $args['source'],
        'hand' => $hand,
        'destination' => $args['destination'],
      ]);
    }

    $notified = [];
    foreach ($cards as $cId => $card) {
      if (in_array($card->getPlayer()->getId(), $notified)) {
        continue;
      }
      $notified[] = $card->getPlayer()->getId();
      Notifications::updateBiomes($card->getPlayer());
    }

    $this->checkAfterListeners($player, ['discarded' => $cardIds, 'sourceId' => $this->getSourceId()]);

    $this->resolveAction([$cardIds]);
  }
}
