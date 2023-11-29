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
}
