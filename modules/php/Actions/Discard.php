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

  public function isOptional($player)
  {
    return $this->getCtxArg('canPass') ?? false;
  }

  public function getDescription()
  {
    $location = $this->getCtxArg('destination') ?? 'discard';
    $msg = clienttranslate('discard to ${location} ${card}');
    if ($location == 'discard') {
      $msg = clienttranslate('Discard ${card}');
    } elseif ($location == 'topOfDeck') {
      $msg = clienttranslate('put ${card} on top of it\'s owner deck');
    } elseif ($location == HAND) {
      $msg = clienttranslate('Return to hand ${card}');
    }

    if (!is_null($this->getCtxArg('cardId') ?? null)) {
      if ($this->getCtxArg('cardId') == ME) {
        $card = Cards::get($this->ctx->getSourceId());
      } else {
        $card = Cards::get($this->getCtxArg('cardId'));
      }
    } else {
      $card = '';
    }

    if (($this->getCtxArg('desc') ?? '') == 'sacrifice') {
      $msg = clienttranslate('Sacrifice ${card}');
    }

    return [
      'log' => $msg,
      'args' => ['location' => $this->getCtxArg('destination') ?? 'discard', 'card' => $card != '' ? $card->getName() : ''],
    ];
  }

  public function stDiscard()
  {
    $force = $this->getCtxArg('force') ?? false;
    if (($this->getCtxArg('canPass') ?? false) == true && !$force) {
      return;
    }

    if (!is_null($this->getCtxArg('cardId') ?? null)) {
      if (!is_array($this->getCtxArg('cardId'))) {
        $this->actDiscard([$this->getCtxArg('cardId')], true);
      } else {
        $this->actDiscard($this->getCtxArg('cardId'), true);
      }
    } elseif ($this->getArg('special') == 'allHand') {
      $this->actDiscard(
        $this->getPlayer()
          ->getHand()
          ->getIds(),
        true
      );
    } elseif ($this->getArg('special') == 'allHandReserve') {
      $this->actDiscard(
        $this->getPlayer()
          ->getHand()->merge($this->getPlayer()
            ->getReserveCards())
          ->getIds(),
        true
      );
    } elseif (
      $this->getArg('special') != 'nightCleanUp' &&
      !is_null($this->getCtxArg('n') ?? null) &&
      $this->getCtxArg('n') == ME
    ) {
      $this->actDiscard([$this->getCtx()->getSourceId()], true);
    }
  }

  public function getPlayer()
  {
    if (!is_null($this->getCtxArg('pId') ?? null)) {
      return Players::get($this->getCtxArg('pId'));
    } else {
      return Players::getActive();
    }
  }

  protected $args = [
    'upTo' => false, // if n > 1, can the player select UP TO n cards or exactly n cards ?
    'destination' => 'discard',
    'n' => 1, // number of card to discard
    'source' => '',
    'nLandmarks' => 0, // only for night clean up
    'special' => '',
    'tapped' => false,
    // 'totalCost' => INFTY
  ];

  public function argsDiscard()
  {
    $player = $this->getPlayer();
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
      $cardId =  $this->getCtxArg('cardId');
      if ($this->getCtxArg('cardId') == ME) {
        $cardId = $this->ctx->getSourceId();
      }
      $cards = [$cardId];
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
      'descSuffix' => $this->isOptional($player) ? 'CanPass' : '',
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
    $player = $this->getPlayer();
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

    foreach ($cardIds as &$cardId) {
      if ($cardId == ME) {
        $cardId = $this->ctx->getSourceId();
      }

      $card = Cards::get($cardId);
      $card->checkLeaveExpeditionListener();
      $card->checkLeaveLandmarkListener();
      // $totalCost += $card->getCostHand();
      if ($card->getLocation() == HAND) {
        $hand = true;
      }
      if (!is_null($card->getExtraDatas()['counterName'] ?? null)) {
        $card->setExtraDatas([]);
        Notifications::deleteCounter($card);
      }
    }
    $cards = Cards::getMany($cardIds);
    $originalLocation = [];
    foreach ($cards as $cId => $card) {
      $originalLocation[$cId] = $card->getLocation();
      if ($this->getArg('tapped')) {
        $card->setTapped(true);
      }
    }

    if ($args['destination'] == 'topOfDeck') {
      Cards::insertOnTop($cardId, 'deck-' . $card->getPlayer()->getId());
    } else {
      Cards::discard($cardIds, $args['destination']);
    }

    $cards = Cards::getMany($cardIds);

    $deleted = [];
    $deletedTokens = [];
    $players = [];
    foreach ($cards as $cardId => $card) {
      $pId = $card->getPlayer()->getId();
      if (!array_key_exists($pId, $players)) {
        $players[$pId] = $card->getPlayer();
      }

      // we discard a card that has fleeting and should go to reserve
      if ($args['destination'] == RESERVE && $card->hasToken(FLEETING) && !$card->isToken()) {
        Cards::discard($cardId);
        if (($this->getCtxArg('desc') ?? '') == 'sacrifice' && $card->isSacrificeAndFleetingDraw()) {
          $this->insertAsChild(['action' => DRAW, 'args' => ['players' => ME]]);
        }
      } elseif (($this->getCtxArg('desc') ?? '') == 'sacrifice' && $card->isSacrificeAndNotFleetingGoToReserve() && !$card->hasToken(FLEETING)) {
        // When we sacrifice a card and has this attribute, goes to reserve if not fleeting
        Cards::discard($cardId, RESERVE);
      }

      if ($card->isToken()) {
        // delete the card as it's a token
        $deletedTokens[] = $cId;
        Cards::discard($cId, 'destroy');
        Cards::delete($cId);
      }

      // remove all meeples on the card
      $seasoned = $card->isSeasoned();
      $toDelete = Meeples::getInLocation('card-' . $cardId)
        ->filter(function ($m) use ($seasoned, $args) {
          return $seasoned == false || ($args['destination'] == RESERVE && $seasoned == true && $m->getType() != BOOST);
        })
        ->getIds();
      Meeples::delete($toDelete);
      $deleted = array_merge($deleted, $toDelete);
    }

    $msg = clienttranslate('${player_name} discards ${n} card(s) from the ${source}');
    if ($args['destination'] == HAND && count($deletedTokens) != count($cards)) {
      $msg = clienttranslate('${player_name} puts ${n} card(s) to players\' hand');
    } elseif ($args['destination'] == 'discard') {
      $msg = clienttranslate('${player_name} discards ${card_names} (${n} card(s))');
    } elseif ($automatic === true) {
      $msg = clienttranslate('${player_name} discards ${n} card(s)');
    }

    $copyCards = $cards;

    // deleting meeples first
    if (!empty($deleted)) {
      Notifications::silentKill($deleted, []);
    }

    if (count($copyCards) != 0) {
      if ($args['destination'] == HAND && count($deletedTokens) != count($copyCards)) {
        Notifications::moveToHand($player, $copyCards, $msg, null, [
          'source' => $args['source'],
          'destination' => $args['destination'],
        ]);
      } elseif ($args['destination'] == MANA) {
        foreach ($players as $pId => $p2) {
          $playerCards = $copyCards->filter(function ($c) use ($pId) {
            return $c->getPId() == $pId;
          });
          $visibleCards = [];
          foreach ($originalLocation as $cId => $location) {
            if ($location == RESERVE) {
              $visibleCards[] = $cId;
            }
          }
          Notifications::discardMana($p2, $playerCards, null, clienttranslate('${player_name} choses ${n} card(s) as mana'));
          if (!empty($visibleCards)) {
            Notifications::publicJinn($p2, $visibleCards);
          }
        }
      } elseif ($args['destination'] == 'topOfDeck') {
        Notifications::putOnDeck($player, $copyCards, [
          'hand' => $hand,
          'destination' => $args['destination'],
          'tokensOnly' => count($deletedTokens) == count($cards)
        ]);
      } else {
        Notifications::publicDiscard($player, $copyCards, $msg, [
          'source' => $args['source'],
          'hand' => $hand,
          'destination' => $args['destination'],
        ]);
      }
    }

    foreach ($players as $player) {
      Notifications::updateBiomes($player);
    }

    $this->checkAfterListeners($player, [
      'cardsToListen' => $cardIds, // we add the discarded cards as they should react even if not played
      'discarded' => $cardIds,
      'originalLocation' => $originalLocation,
      'cards' => $cards,
      'sacrifice' => ($this->getCtxArg('desc') ?? '') == 'sacrifice',
      'sourceId' => $this->getSourceId(),
    ]);

    $this->resolveAction([$cardIds]);
  }
}
