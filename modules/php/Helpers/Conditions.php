<?php

namespace ALT\Helpers;

use ALT\Core\Globals;
use ALT\Managers\Cards;
use ALT\Managers\Players;

// Conditions
abstract class Conditions
{
  // Checking a condition/several conditions
  public static function check($power, $card, $event)
  {
    $conditions = [];
    if (isset($power['conditions']) && is_array($power['conditions'])) {
      $conditions = $power['conditions'];
    }

    if (isset($power['condition'])) {
      $conditions[] = $power['condition'];
    }

    foreach ($conditions as $cond) {
      $t = explode(':', $cond);
      $condFct = $t[0];
      $condArgs = array_slice($t, 1);

      if (self::$condFct($card, $event, ...$condArgs) === false) {
        return false;
      }
    }

    return true;
  }


  public function isFromReserve($card, $event)
  {
    return ($event['from'] ?? null) == RESERVE;
  }

  ///////////////////////////////////////////////
  //  ____  _                         ___    _ 
  // |  _ \| | __ _ _   _  ___ _ __  |_ _|__| |
  // | |_) | |/ _` | | | |/ _ \ '__|  | |/ _` |
  // |  __/| | (_| | |_| |  __/ |     | | (_| |
  // |_|   |_|\__,_|\__, |\___|_|    |___\__,_|
  //                |___/                      
  ///////////////////////////////////////////////

  public static function isMe($card, $event)
  {
    return ($event['pId'] ?? null) == $card->getPId();
  }

  public static function isNotMe($card, $event)
  {
    return ($event['pId'] ?? null) != $card->getPId();
  }

  public static function isFirstPlayer($card, $event)
  {
    return self::isMe($card, $event) && $card->getPId() == Globals::getFirstPlayer();
  }

  public static function isNotFirstPlayer($card, $event)
  {
    return self::isMe($card, $event) && $card->getPId() != Globals::getFirstPlayer();
  }


  ////////////////////////////////////////////////////////////
  //  ____                ____  _                         
  // |  _ \  __ _ _   _  |  _ \| |__   __ _ ___  ___  ___ 
  // | | | |/ _` | | | | | |_) | '_ \ / _` / __|/ _ \/ __|
  // | |_| | (_| | |_| | |  __/| | | | (_| \__ \  __/\__ \
  // |____/ \__,_|\__, | |_|   |_| |_|\__,_|___/\___||___/
  //              |___/                                   
  ////////////////////////////////////////////////////////////

  public static function isAfternoon($card, $event)
  {
    return Globals::isDayPhase();
  }

  public static function isNotFirstTurn($card, $event)
  {
    return Globals::getDay() != 1;
  }

  public static function movesStormsWithForest($card, $event)
  {
    $stormMoves = Globals::getStormMoves();
    if (!isset($stormMoves[$card->getPId()]) || $card->getPId() != $event['pId'] || !isset($stormMoves[$card->getPId()][$event['expedition']])) {
      return false;
    }

    $move = $stormMoves[$card->getPId()][$event['expedition']];
    if (in_array(FOREST, $move['biomes']) && $move['moves'] >= 1) {
      return true;
    }

    return false;
  }

  public static function hasNotMoved($card, $event)
  {
    return $event['pId'] == $card->getPId() &&
      (
        !isset(Globals::getStormMoves()[$card->getPId()]) ||
        (
          (Globals::getStormMoves()[$card->getPId()][STORM_LEFT]['moves'] ?? 0) + (Globals::getStormMoves()[$card->getPId()][STORM_RIGHT]['moves'] ?? 0)
        ) == 0);
  }

  public static function myExpeditionHasNotMoved($card, $event)
  {
    $stormMoves = Globals::getStormMoves()[$card->getPId()] ?? null;
    $stormMoves = $stormMoves[$card->getLocation()] ?? null;
    return $event['pId'] == $card->getPId() && (is_null($stormMoves) || ($stormMoves['moves'] ?? 0) == 0);
  }


  /////////////////////////////////////////
  //   ____            _             _ 
  //  / ___|___  _ __ | |_ _ __ ___ | |
  // | |   / _ \| '_ \| __| '__/ _ \| |
  // | |__| (_) | | | | |_| | | (_) | |
  //  \____\___/|_| |_|\__|_|  \___/|_|
  /////////////////////////////////////////

  public static function canPay($card, $event, $n)
  {
    return $card->getPlayer()->getMana() >= $n;
  }

  public static function hasCardsInHand($card, $event)
  {
    return $card->getPlayer()->getHand()->count() > 0;
  }

  public static function hasReserve($card, $event)
  {
    return $card->getPlayer()->getReserveCards()->count() > 0;
  }

  public static function hasLess8Mana($card, $event)
  {
    return $card->getPlayer()->getTotalMana() < 8;
  }


  public static function hasControl($card, $event, $type, $n, $excludeMyself = 'false', $state = 'all', $op = "GTE")
  {
    $types = [CHARACTER, TOKEN];
    if ($type == TOKEN) $types = [TOKEN];
    if ($type == LANDMARK) $types = [LANDMARK];

    $cards = $card
      ->getPlayer()
      ->getPlayedCards($types);

    if (in_array($type, SUBTYPES)) {
      $cards = $cards->filter(fn ($c) => in_array($type, $c->getSubtypes()));
    }

    if ($excludeMyself === "true") {
      $cards = $cards->filter(fn ($c) => $c->getId() != $card->getId());
    }

    if ($state != 'all') {
      if ($state == 'boosted') {
        $cards = $cards->filter(fn ($c) => $c->hasToken(BOOST));
      }
    }

    $m = $cards->count();
    if ($op == "GTE") return $m >= $n;
    if ($op == "LTE") return $m <= $n;
  }

  public static function has3WithZeroStat($card, $event)
  {
    $playedCards = $card->getPlayer()->getPlayedCards();
    $hasZero = 0;
    foreach ($playedCards as $cId => $playedCard) {
      if (!in_array($playedCard->getType(), [TOKEN, CHARACTER])) {
        continue;
      }

      foreach ($playedCard->getBiomes() as $biome => $value) {
        if ($value == 0) {
          $hasZero++;
        }
      }
    }

    return $card->getPId() == $event['pId'] &&
      $hasZero >= 3;
  }

  public static function canSacrifice($card, $event)
  {
    return Players::get($event['pId'])->getPlayedCards([CHARACTER, TOKEN])->count() > 0;
  }

  public static function hasControlFleetingAnchoredAsleep($card, $event)
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


  ///////////////////////////////////////////////////////////////////////////////
  //   ____              _   ____                            _   _           
  //  / ___|__ _ _ __ __| | |  _ \ _ __ ___  _ __   ___ _ __| |_(_) ___  ___ 
  // | |   / _` | '__/ _` | | |_) | '__/ _ \| '_ \ / _ \ '__| __| |/ _ \/ __|
  // | |__| (_| | | | (_| | |  __/| | | (_) | |_) |  __/ |  | |_| |  __/\__ \
  //  \____\__,_|_|  \__,_| |_|   |_|  \___/| .__/ \___|_|   \__|_|\___||___/
  //                                        |_|                              
  ///////////////////////////////////////////////////////////////////////////////

  public static function notFleeting($card, $event)
  {
    return !$card->hasToken(FLEETING) && !($event['fleeting'] ?? false);
  }

  public static function notTapped($card, $event)
  {
    return !$card->isTapped();
  }

  public static function notUsed($card, $event)
  {
    return ($card->getExtraDatas()['userPower'] ?? false) == false;
  }

  public static function hasBoost($card, $event, $n = 1, $op = "GTE")
  {
    // USELESS ?? self::isMe($card, $event) &&
    $m = $card->countToken(BOOST);
    // EVENT keep information about the card previous status in case it was move to discard
    if (isset($event['boost'])) $m = $event['boost'];

    if ($op == "GTE") return $m >= $n;
    if ($op == "LTE") return $m <= $n;
    die("Unknown op for hasBoost");
  }


  public static function hasCounterOnCard($card, $event, $n = 1, $op = "GTE")
  {
    $m = ($card->getExtraDatas()['counter'] ?? 0);
    if ($op == "GTE") return $m >= $n;
    if ($op == "LTE") return $m <= $n;
    die("Unknown op for hasCounterOnCard");
  }

  ///////////////////////////////////////////////////////////// 
  //   ____  _                      _    ____              _ 
  //  |  _ \| | __ _ _   _  ___  __| |  / ___|__ _ _ __ __| |
  //  | |_) | |/ _` | | | |/ _ \/ _` | | |   / _` | '__/ _` |
  //  |  __/| | (_| | |_| |  __/ (_| | | |__| (_| | | | (_| |
  //  |_|   |_|\__,_|\__, |\___|\__,_|  \____\__,_|_|  \__,_|
  //                 |___/                                   
  ///////////////////////////////////////////////////////////// 

  public static function isPlayEvent($card, $event, $meOnly = true)
  {
    if ($event['playCard'] ?? false) {
      return false;
    }

    if ($meOnly && !self::isMe($card, $event)) {
      return false;
    }

    return true;
  }

  public static function isCardPlayed($card, $event, $type, $cost = null, $op = "GTE", $excludeMyself = "")
  {
    if (!self::isPlayEvent($card, $event)) {
      return false;
    }
    $card = Cards::get($event['playedCard']);

    // Exclude myself
    if ($excludeMyself == "true" && $card->getId() == $event['playedCard']) {
      return false;
    }

    // Type check
    if (in_array($type, [PERMANENT, TOKEN, LANDMARK, SPELL])) {
      if ($event['cardType'] != $type) {
        return false;
      }
    }
    if ($type == CHARACTER && !in_array($event['cardType'], [CHARACTER, TOKEN])) {
      return false;
    }
    if ($type == 'characterOnly' && $event['cardType'] != CHARACTER) {
      return false;
    }

    // Subtype check
    if (in_array($type, SUBTYPES)) {
      if (!in_array($type, $card->getSubtypes())) {
        return false;
      }
    }

    // Cost check
    if (!is_null($cost)) {
      $costHand = $card->getCostHand();
      if ($op == "GTE" && $costHand < $cost) return false;
      if ($op == "LTE" && $costHand > $cost) return false;
      if ($op == "E" && $costHand != $cost) return false;
    }

    return true;
  }

  public static function isCardPlayedWithZeroStat($card, $event)
  {
    if (!self::isCardPlayed($card, $event, CHARACTER)) {
      return false;
    }

    $playedCard = Cards::get($event['playedCard']);
    $hasZero = false;
    foreach ($playedCard->getBiomes() as $biome => $value) {
      if ($value == 0) {
        return true;
      }
    }

    return false;
  }


  public static function isCharacterFromReserveNotBlocked($card, $event)
  {
    if (!self::isCardPlayed($card, $event, CHARACTER)) {
      return false;
    }

    return ($event['from'] == RESERVE  || (Globals::getAdditionalEffect()[$event['cardType']] ?? null)) &&
      !Players::hasOpponentBlockingPower($card->getPlayer(), $event['to']);
  }

  public static function isCharacterCostHigherThanCounter($card, $event)
  {
    if (!self::isCardPlayed($card, $event, CHARACTER)) {
      return false;
    }

    $cardPlayed = Cards::get($event['playedCard']);
    return ($event['playedFree'] ?? false) == false &&
      $cardPlayed->getCostHand() >= ($card->getExtraDatas()['counter'] ?? 0);
  }


  /**********************************
   **********************************
   **********************************
   ************* TODO ***************
   **********************************
   **********************************
   *********************************/


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


  public static function isCharacterBoostedAndUntap($card, $event)
  {
    return !$card->isTapped() &&
      $event['gain']['type'] == BOOST &&
      Cards::get($event['gain']['cardId'])->getPId() == $card->getPId();
  }


  public static function notMeandDrawNotMana($card, $event)
  {
    return $event['pId'] != $card->getPId() && ($event['location'] ?? HAND) != MANA;
  }



  public static function isDiscardedFromHandToReserve($card, $event)
  {
    $cardId = $card->getId();
    return in_array($cardId, $event['discarded']) &&
      $event['originalLocation'][$cardId] == HAND &&
      (is_array($event['cards'][$cardId]) ? $event['cards'][$cardId]['location'] : $event['cards'][$cardId]->getLocation()) == RESERVE;
  }

  public static function isCharacterSacrifice($card, $event)
  {
    $found = false;
    foreach ($event['cards'] as $cId => $card2) {

      if (is_array($card2)) {
        $type = $card2['properties']['type'];
      } else {
        $type = $card2->getType();
      }

      if (in_array($type, [CHARACTER, TOKEN])) {
        $found = true;
        break;
      }
    }
    return $card->getPId() == $event['pId'] && $event['sacrifice'] == true && $found;
  }

  public static function isSacrificed($card, $event)
  {
    foreach ($event['cards'] as $cdId => $card2) {
      if ($cdId == $card->getId()) {
        $found = true;
      }
    }
    return $card->getPId() == $event['pId'] && $event['sacrifice'] == true && $found;
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

  public static function isSourceAndDiscardSpell($card, $event)
  {
    if ($card->getPId() != $event['pId'] || $card->getId() != $event['sourceId']) {
      return false;
    }

    return Cards::getMany($event['discarded'], false)
      ->where('type', SPELL)
      ->count() > 0;
  }


  // Treyst listeners
  public static function isDiscardedFromReserveAndLess5Counters($card, $event)
  {
    if (!Globals::isDayPhase()) {
      return false;
    }

    if (($card->getExtraDatas()['counter'] ?? 0) >= 5) {
      return false;
    }

    $found = false;
    foreach ($event['originalLocation'] as $cId => $location) {
      if ($location == RESERVE) {
        $found = true;
      }
    }
    if (!$found) {
      return false;
    }

    foreach ($event['cards'] as $c) {
      if ($card->getPId() == $c->getPId()) {
        return true;
      }
    }
    return false;
  }

  public static function isFromReserveAfternoon($card, $event)
  {
    if (!Globals::isDayPhase()) {
      return false;
    }

    if ($event['type'] == 'Discard') {
      $found = false;
      foreach ($event['originalLocation'] as $cId => $location) {
        if ($location == RESERVE) {
          $found = true;
        }
      }
      if (!$found) {
        return false;
      }

      foreach ($event['cards'] as $c) {
        if ($card->getPId() == $c->getPId()) {
          return true;
        }
      }
      return false;
    } else {
      $card->getPId() == $event['pId'] &&
        $event['from'] == RESERVE;
    }
  }
}
