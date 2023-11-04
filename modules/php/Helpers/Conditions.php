<?php
namespace ALT\Helpers;

use ALT\Core\Globals;

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
}
