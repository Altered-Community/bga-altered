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

class NightCleanup extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_NIGHT_CLEANUP;
  }

  public function getDescription()
  {
    return clienttranslate('Night cleanup');
  }

  protected $args = [
    'nReserve' => 0,
    'nLandmarks' => 0,
  ];

  public function argsNightCleanup()
  {
    $player = $this->getPlayer();
    $reserve = $player->getReserveCards()->filter(function ($c) {
      return !$c->isIgnoreReserveLimit() || $c->isTapped();
    });
    $landmarks = $player->getLandmarks();
    $exhaustedSlots = $player->getExhaustedReserveSlots();

    $nReserve = $this->getArg('nReserve');
    $nLandmarks = $this->getArg('nLandmarks');

    return [
      'nReserve' => $nReserve,
      'nLandmarks' => $nLandmarks,
      'exhaustedSlots' => $exhaustedSlots,
      'descSuffix' => $nReserve == 0 ? 'landmarksOnly' : ($nLandmarks == 0 ? 'reserveOnly' : ''),
      '_private' => [
        'active' => [
          'reserveCards' => $reserve->getIds(),
          'landmarkCards' => $landmarks->getIds(),
          'cards' => $reserve->merge($landmarks)->getIds(),
        ],
      ],
    ];
  }

  public function actNightCleanup($reserveCardIds, $landmarkCardIds)
  {
    $player = $this->getPlayer();
    $args = $this->argsNightCleanup();
    $pArgs = $args['_private']['active'];


    // Number of cards
    if (count($reserveCardIds) != $args['nReserve'] || count($landmarkCardIds) != $args['nLandmarks']) {
      throw new \BgaVisibleSystemException('You must select the correct number of cards. Should not happen');
    }

    // Valid card ids
    if (!empty(array_diff($reserveCardIds, $pArgs['reserveCards'])) || !empty(array_diff($landmarkCardIds, $pArgs['landmarkCards']))) {
      throw new \BgaVisibleSystemException('You selected a card that should not be discarded. Should not happen');
    }

    $cardIds = array_merge($reserveCardIds, $landmarkCardIds);

    $cards = Cards::getMany($cardIds);
    $deletedMeeples = [];
    $destination = DISCARD_PILE;

    // Alizé, some cards can be kept if they are exhausted
    if ($args['exhaustedSlots'] >= 0 && count($reserveCardIds) > $args['nReserve']) {
      $exhausted = 0;
      $nonExhausted = 0;
      foreach ($cards as $cId => $card) {
        if ($card->isTapped()) {
          $exhausted++;
        } else {
          $nonExhausted++;
        }
      }
      if ($nonExhausted > ($args['nReserve'] - $args['exhaustedSlots'])) {
        throw new \BgaUserException(clienttranslate('You selected too many ready cards to keep'));
      }
    }


    foreach ($cards as $cId => $card) {
      // Save information about original location
      $originalLocation = $card->getLocation();
      if ($originalLocation == LANDMARK) {
        $card->checkLeaveListener($destination, true, true); // Check leave listener
      } elseif (in_array($originalLocation, [RESERVE, STORM_LEFT, STORM_RIGHT])) {
        $card->checkLeaveListener($destination, true); // Check leave listener
      }

      // Discard the card
      $m = $card->discardTo($destination, [], true);
      $deletedMeeples = array_merge($deletedMeeples, $m);

      $afterCleanup = Globals::getAfterNightCleanup();


      // Check listener
      $reactions = $this->logReactions('Discard', $player, [
        'discardCard' => true,
        'cardsToListen' => $cardIds, // we add the discarded cards as they should react even if not played
        'discarded' => $cId,
        'from' => $originalLocation,
        'to' => $destination,
      ]);
      if (!is_null($reactions)) {
        foreach ($reactions as $r => $reaction) {
          $afterCleanup[$reaction['pId']][] = $reaction;
        }
      }
      Globals::setAfterNightCleanup($afterCleanup);
    }


    // Notify deleting meeples first
    if (!empty($deletedMeeples)) {
      Notifications::silentKill($deletedMeeples, []);
    }

    // Notify cards moving
    $msg = clienttranslate('${player_name} discards ${card_names} (${nReserve} card(s) in reserve, ${nLandmarks} landmark(s))');
    if (empty($landmarkCardIds)) {
      $msg = clienttranslate('${player_name} discards ${card_names} (${nReserve} card(s) in reserve)');
    } elseif (empty($reserveCardIds)) {
      $msg = clienttranslate('${player_name} discards ${card_names} (${nLandmarks} landmark(s))');
    }

    Notifications::publicDiscard($player, $cards, $msg, [
      'nReserve' => count($reserveCardIds),
      'nLandmarks' => count($landmarkCardIds),
      'destination' => $destination,
    ]);
  }
}
