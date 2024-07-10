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
use ALT\Helpers\Collection;
use ALT\Helpers\Utils;
use ALT\Models\Player;

class Discard extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_DISCARD;
  }

  protected $args = [
    'upTo' => false, // if n > 1, can the player select UP TO n cards or exactly n cards ?
    'destination' => 'discard',
    'n' => 1, // number of card to discard
    'cardId' => null, // Card to discard
    'source' => '',
    'nLandmarks' => 0, // only for night clean up
    'special' => '',
    'tapped' => false,

    'canPass' => false, // Is this optional ?
    'force' => false,  // NO IDEA
  ];

  public function isOptional($player)
  {
    return $this->getArg('canPass');
  }

  public function isSacrifice()
  {
    return ($this->getCtxArg('desc') ?? '') == 'sacrifice';
  }

  public function getDescription()
  {
    $location = $this->getArg('destination');

    // Msg
    $msgs = [
      DISCARD_PILE => clienttranslate('Discard ${card}'),
      TOP_OF_DECK => clienttranslate('put ${card} on top of it\'s owner deck'),
      HAND => clienttranslate('Return to hand ${card}'),
    ];
    $msg = $msgs[$location] ?? clienttranslate('discard to ${location} ${card}');
    if ($this->isSacrifice()) {
      $msg = clienttranslate('Sacrifice ${card}');
    }

    // Card (if any)
    $cardId = $this->getArg('cardId');
    $card = '';
    if ($cardId == ME) {
      $card = Cards::get($this->getSourceId());
    } else if (!is_null($cardId)) {
      $card = Cards::get($cardId, false);
    }

    return [
      'log' => $msg,
      'args' => [
        'location' => $location,
        'card' => $card == '' ? '' : ($card instanceof Collection ? clienttranslate(' multiple cards') : $card->getName()),
        'i18n' => ['location'],
      ],
    ];
  }

  public function argsDiscard()
  {
    $player = $this->getPlayer();
    $cardIds = [];

    $cardId = $this->getArg('cardId');
    $source = $this->getArg('source');

    // Any card targeted ? (might be several cards)
    if (!is_null($cardId)) {
      $cardIds = is_array($cardId) ? $cardId : [$cardId];
      // Replace ME by source
      $cardIds = array_map(fn ($cId) => $cId == ME ? $this->getSourceId() : $cId, $cardIds);
    }
    // Any source specified ? From Hand
    elseif ($source == HAND) {
      $cardIds = $player->getHand()->getIds();
    }
    // Any source specified ? From Reserve
    elseif ($source == RESERVE) {
      $cardIds = $player->getReserveCards()->getIds();
    }
    // Default behavior => cards played
    else {
      $cardIds = $player->getPlayedCards()->getIds();
    }

    return [
      'n' => $this->getArg('n'),
      'source' => $source,
      'destination' => $this->getArg('destination'),
      'descSuffix' => $this->isOptional($player) ? 'CanPass' : '',
      'upTo' => $this->getArg('upTo'),
      '_private' => [
        'active' => [
          'cards' => $cardIds,
        ],
      ],
    ];
  }

  public function stDiscard()
  {
    $force = $this->getArg('force');
    // Nothing automatic if player can pass
    if ($this->getArg('canPass') && !$force) {
      return;
    }

    $cardIds = null;
    $args = $this->argsDiscard();

    // Any card targeted ? (might be several cards)
    $cardId = $this->getArg('cardId');
    if (!is_null($cardId)) {
      $cardIds = $args['_private']['active']['cards'];
    }
    // Discard all hand (Loki)
    elseif ($this->getArg('special') == 'allHand') {
      $cardIds = $this->getPlayer()->getHand()->getIds();
    }
    // Discard all hand and reserve (Rare Loki)
    elseif ($this->getArg('special') == 'allHandReserve') {
      $cardIds = $this->getPlayer()->getHand()
        ->merge($this->getPlayer()->getReserveCards())
        ->getIds();
    }
    // Discard myself
    else if ($this->getArg('n') == ME) {
      $cardIds = [$this->getCtx()->getSourceId()];
    }

    // Call actDiscard instead of returning values to ensure we bypass the checks
    // => useful when upTo = false and we need to discard 3 cards and only 2 are valids
    if (!is_null($cardIds)) {
      $this->actDiscard($cardIds, true);
    }
  }



  public function actDiscard($cardIds, $automatic = false)
  {
    $player = $this->getPlayer();
    $args = $this->argsDiscard();
    $pArgs = $args['_private']['active'];

    // Sanity checks (bypass if automatic)
    if (!$automatic) {
      // Number of cards
      $n = $args['n'] + ($args['nLandmarks'] ?? 0);
      $upTo = $args['upTo'];
      if ((!$upTo && count($cardIds) != $n) || ($upTo && count($cardIds) > $n)) {
        throw new \BgaVisibleSystemException('You must select the correct number of cards. Should not happen');
      }

      // Valid card ids
      $validIds = ($pArgs['cards'] ?? []) + ($pArgs['reserveCards'] ?? []) + ($pArgs['landmarkCards'] ?? []);
      if (!empty(array_diff($cardIds, $validIds))) {
        throw new \BgaVisibleSystemException('You selected a card that should not be discarded. Should not happen');
      }
    }

    // Discard them
    $cards = Cards::getMany($cardIds);
    $deletedTokens = [];
    $deletedMeeples = [];
    $players = [];
    $visibleCards = [];
    $hand = false;

    foreach ($cards as $cId => $card) {
      $players[$card->getPId()] = $card->getPlayer();
      $destination = $args['destination'];
      $hasFleeting = $card->hasToken(FLEETING);

      // We discard a card that has fleeting and should go to reserve
      if (in_array($destination, [RESERVE, DISCARD_PILE]) && $hasFleeting) {
        $destination = DISCARD_PILE;
      }
      // Save information about original location
      $originalLocation = $card->getLocation();
      if (in_array($originalLocation, [RESERVE, STORM_LEFT, STORM_RIGHT])) {
        $visibleCards[] = $cId;
      } else if ($originalLocation == HAND) {
        $hand = true;
      }

      // Special case of MoonlightJellyFish
      if ($this->isSacrifice()) {
        // Sactifice a fleeting
        if ($hasFleeting && $card->isSacrificeAndFleetingDraw()) {
          $this->insertAsChild(['action' => DRAW, 'args' => ['players' => ME]]);
        }
        // Sacrifice a non fleeting
        else if (!$hasFleeting && $card->isSacrificeAndNotFleetingGoToReserve()) {
          $destination = RESERVE;
        }
      }

      // Destroy the card if token
      if ($card->isToken()) {
        $deletedTokens[] = $cId;
        $m = $card->discardTo('destroy');
        $deletedMeeples = array_merge($deletedMeeples, $m);
      }
      // Otherwise move the card
      else {
        $m = $card->discardTo($destination);
        $deletedMeeples = array_merge($deletedMeeples, $m);
        if ($destination == TOP_OF_DECK) {
          Cards::insertOnTop($cId, 'deck-' . $card->getPlayer()->getId());
        }

        // Do we need to tap the card ? (LY_Rare_MightyJinn)
        if ($this->getArg('tapped')) {
          $card->setTapped(true);
        }
      }

      // Check listener
      $this->checkAfterListeners($player, [
        'discardCard' => true,
        'cardsToListen' => $cardIds, // we add the discarded cards as they should react even if not played
        'cardId' => $cId,
        'from' => $originalLocation,
        'to' => $destination,
        'sacrifice' => $this->isSacrifice(),
        'sourceId' => $this->getSourceId(),
      ]);
    }

    // Notify deleting meeples first
    if (!empty($deletedMeeples)) {
      Notifications::silentKill($deletedMeeples, []);
    }

    // Notify cards moving, if any
    if (count($cards) > 0) {
      $destination = $args['destination'];

      // To HAND
      if ($destination == HAND && count($deletedTokens) != count($cards)) {
        $msg = clienttranslate('${player_name} puts ${n} card(s) to players\' hand');
        Notifications::moveToHand($player, $cards, $msg, null, [
          'source' => $args['source'],
          'destination' => HAND,
        ]);
      }
      // To MANA
      elseif ($destination == MANA) {
        // One notif per player
        foreach ($players as $pId => $p2) {
          $playerCards = $cards->filter(fn ($c) => $c->getPId() == $pId);
          $visiblePlayerCards = $cards->filter(fn ($c) => in_array($c->getId(), $visibleCards));

          if (!$visiblePlayerCards->empty()) {
            Notifications::publicDiscardToMana($p2, $visiblePlayerCards);
          } else {
            Notifications::discardMana($p2, $playerCards, null, clienttranslate('${player_name} choses ${n} card(s) as mana'));
          }
        }
      }
      // To TOP OF DECK
      elseif ($destination == TOP_OF_DECK) {
        Notifications::putOnDeck($player, $cards, [
          'hand' => $hand,
          'destination' => $args['destination'],
          'tokensOnly' => count($deletedTokens) == count($cards),
        ]);
      }
      // Default
      else {
        $msg = clienttranslate('${player_name} discards ${n} card(s) from the ${source}');
        if ($destination == DISCARD_PILE) {
          $msg = clienttranslate('${player_name} discards ${card_names} (${n} card(s))');
        } elseif ($automatic) {
          $msg = clienttranslate('${player_name} discards ${n} card(s)');
        }

        Notifications::publicDiscard($player, $cards, $msg, [
          'source' => $args['source'],
          'hand' => $hand,
          'destination' => $args['destination'],
        ]);
      }
    }

    // Resolve action if automatic since we are bypassing usual flow with return
    if ($automatic) {
      $this->resolveAction([$cardIds]);
    }
  }
}
