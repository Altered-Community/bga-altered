<?php

namespace ALT\Helpers;

use ALT\Core\Globals;
use ALT\Managers\Cards;

// Conditions
abstract class Conditions
{
  public static function isFirstPlayer($card, $event)
  {
    return ($event['pId'] ?? null) == $card->getPId() && $card->getPId() == Globals::getFirstPlayer();
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
    return $event['pId'] == $card->getPId() &&
      $event['gain']['type'] == BOOST &&
      Cards::get($event['gain']['cardId'])->getPId() == $card->getPId();
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

  public static function has5CounterOnCard($card, $event)
  {
    return $event['pId'] == $card->getPId() && ($card->getExtraDatas('counter') ?? 0) >= 5;
  }

  public static function control3OtherCharacters($card, $event)
  {
    return $card
      ->getPlayer()
      ->getPlayedCards([CHARACTER, TOKEN])
      ->filter(function ($c) use ($card) {
        return $c->getId() != $card->getId();
      })
      ->count() >= 3;
  }

  public static function control1Token($card, $event)
  {
    return $card
      ->getPlayer()
      ->getPlayedCards([TOKEN])
      ->count() >= 1;
  }

  public static function control2Plants($card, $event)
  {
    return $card
      ->getPlayer()
      ->getPlayedCards([CHARACTER, TOKEN])
      ->filter(function ($c) use ($card) {
        return in_array(PLANT, $c->getSubtypes());
      })
      ->count() >= 2;
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

  public static function isRobotPlayed($card, $event)
  {
    return $event['playCard'] === true &&
      $card->getPId() == $event['pId'] &&
      in_array(ROBOT, Cards::get($event['playedCard'])->getSubtypes());
  }

  public static function isWithZeroStat($card, $event)
  {
    $playedCard = Cards::get($event['playedCard']);
    $hasZero = false;
    foreach ($playedCard->getBiomes() as $biome => $value) {
      if ($value == 0) {
        $hasZero = true;
      }
    }

    return $event['playCard'] === true &&
      $card->getPId() == $event['pId'] &&
      $hasZero;
  }

  public static function isCharacterPlayed($card, $event)
  {
    return $event['playCard'] === true &&
      $card->getPId() == $event['pId'] &&
      in_array(Cards::get($event['playedCard'])->getType(), [CHARACTER, TOKEN]);
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

    return Cards::getMany($event['discarded'], false)
      ->where('type', PERMANENT)
      ->count() > 0;
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

  public static function movesStormsWithForest($card, $event)
  {
    $stormMoves = Globals::getStormMoves();
    if (!isset($stormMoves[$card->getPId()])) {
      return false;
    }

    return $card->getPId() == $event['pId'] && in_array(FOREST, $stormMoves[$card->getPId()]['biomes']) && $stormMoves[$card->getPId()]['moves'] >= 1;
  }
}
