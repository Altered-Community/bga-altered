<?php

namespace ALT\Helpers;

use ALT\Core\Globals;
use ALT\Managers\Cards;

// Conditions
abstract class Conditions
{
  public static function isFirstPlayer($card, $event)
  {
    return $event['pId'] == $card->getPId() && $card->getPId() == Globals::getFirstPlayer();
  }

  public static function boostedByOtherCard($card, $event)
  {
    if ($event['sourceId'] != $card->getId() && $event['gain']['type'] == BOOST && $event['gain']['cardId'] == $card->getId()) {
      return true;
    }
    return false;
  }

  public static function isCharacterBoosted($card, $event)
  {
    return $event['pId'] == $card->getPId()  && $event['gain']['type'] == BOOST && Cards::get($event['gain']['cardId'])->getPId() == $card->getPId();
  }

  public static function firstCharacterPlayed($card, $event)
  {
    return $event['playCard'] === true &&
      $card->getPId() == $event['pId'] &&
      $event['cardType'] == CHARACTER &&
      ($card->getExtraDatas()['userPower'] ?? false) == false;
  }

  public static function myTurn($card, $event)
  {
    return $event['pId'] == $card->getPId();
  }


  public static function hasCounterOnCard($card, $event)
  {
    return $event['pId'] == $card->getPId() && ($card->getExtraDatas('counter') ?? 0) > 0;
  }

  public static function control3OtherCharacters($card, $event)
  {
    return $card
      ->getPlayer()
      ->getPlayedCards(CHARACTER)
      ->filter(function ($c) use ($card) {
        return $c->getId() != $card->getId();
      })
      ->count() >= 3;
  }

  public static function control2Landmarks($card, $event)
  {
    return $card
      ->getPlayer()
      ->getLandmarks()
      ->count() >= 2;
  }

  public static function isPermanentAndCost3($card, $event)
  {
    // check card triggering the effect isn't tapped
    return $event['playCard'] === true &&
      $card->getPId() == $event['pId'] &&
      !$card->isTapped() &&
      $event['cardType'] == PERMANENT &&
      Cards::get($event['playedCard'])->getCostHand() >= 3;
  }

  public static function isDiscardedFromHandToReserve($card, $event)
  {
    $cardId = $card->getId();

    // throw new \feException(in_array($cardId, $event['discarded'])  &&
    //   $event['originalLocation'][$cardId] == HAND); // &&
    // //   $event['cards'][$cardId]->getLocation() == RESERVE);

    return in_array($cardId, $event['discarded']) &&
      $event['originalLocation'][$cardId] == HAND &&
      $event['cards'][$cardId]->getLocation() == RESERVE;
  }

  public static function isSourceAndDiscardPermanent($card, $event)
  {
    if ($card->getPId() != $event['pId'] || $card->getId() != $event['sourceId']) {
      return false;
    }

    return Cards::getMany($event['discarded'], false)->where('type', PERMANENT)->count() > 0;
  }

  public static function isCharacterFromReserve($card, $event)
  {
    return $event['playCard'] === true &&
      $card->getPId() == $event['pId'] &&
      $event['cardType'] == CHARACTER &&
      $event['from'] == RESERVE;
  }

  public static function isBoosted($card, $event)
  {
    return $card->hasToken(BOOST) || ($event['boosted'] ?? false) == true;
  }

  public static function costHigherThanCounter($card, $event)
  {
    return $event['playCard'] === true &&
      $card->getPId() == $event['pId'] &&
      Cards::get($event['playedCard'])->getCostHand() >= $card->getExtraDatas('counter');
  }

  public static function hasFleetingAnchoredAsleep($card, $event)
  {
    $asleep = [];
    $anchored = [];
    $fleeting = [];
    foreach ($card->getPlayer()->getPlayedCards() as $cId => $c) {
      if ($c->hasToken(ASLEEP)) {
        $asleep[] = $cId;
      }
      if ($c->hasToken(ANCHORED)) {
        $anchored[] = $cId;
      }
      if ($c->hasToken(FLEETING)) {
        $fleeting[] = $cId;
      }
    }

    $combination = Utils::cartesian([$asleep, $anchored, $fleeting]);
    Utils::filter($combination, function ($comb) {
      return count(array_unique($comb)) == 3;
    });

    return count($combination) >= 1;
  }
}
