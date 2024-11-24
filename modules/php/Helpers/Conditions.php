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
      if (is_array($power['condition'])) {
        $conditions = array_merge($conditions, $power['condition']);
      } else {
        $conditions[] = $power['condition'];
      }
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


  ///////////////////////////////////////
  //    ____                           _ 
  //   / ___| ___ _ __   ___ _ __ __ _| |
  //  | |  _ / _ \ '_ \ / _ \ '__/ _` | |
  //  | |_| |  __/ | | |  __/ | | (_| | |
  //   \____|\___|_| |_|\___|_|  \__,_|_|
  ///////////////////////////////////////

  public static function isFromReserve($card, $event)
  {
    return ($event['from'] ?? null) == RESERVE;
  }

  public static function isToReserve($card, $event)
  {
    return ($event['to'] ?? null) == RESERVE;
  }

  public static function isSource($card, $event)
  {
    return $card->getId() == $event['sourceId'];
  }

  public static function hasSameOwner($card, $event)
  {
    $cardId = $event['cardId'] ?? null;
    if (is_null($cardId)) {
      return false;
    }
    return Cards::get($cardId)->getPId() == $card->getPId();
  }

  public static function excludeSelf($card, $event)
  {
    return $card->getId() != $event['cardId'];
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
    $storm = $event['expedition'] ?? $card->getLocation();
    if (
      !isset($stormMoves[$card->getPId()]) ||
      $card->getPId() != $event['pId'] ||
      !isset($stormMoves[$card->getPId()][$storm])
    ) {
      return false;
    }

    $move = $stormMoves[$card->getPId()][$storm];
    if (in_array(FOREST, $move['biomes']) && $move['moves'] >= 1) {
      return true;
    }

    return false;
  }

  public static function hasNotMoved($card, $event)
  {
    return $event['pId'] == $card->getPId() &&
      (!isset(Globals::getStormMoves()[$card->getPId()]) ||
        (Globals::getStormMoves()[$card->getPId()][STORM_LEFT]['moves'] ?? 0) +
        (Globals::getStormMoves()[$card->getPId()][STORM_RIGHT]['moves'] ?? 0) ==
        0);
  }

  public static function myExpeditionHasNotMoved($card, $event)
  {
    $stormMoves = Globals::getStormMoves()[$card->getPId()] ?? null;
    $stormMoves = $stormMoves[$card->getLocation()] ?? null;
    return $event['pId'] == $card->getPId() && (is_null($stormMoves) || ($stormMoves['moves'] ?? 0) == 0);
  }

  public static function myExpeditionHasMoved($card, $event)
  {
    $stormMoves = Globals::getStormMoves()[$card->getPId()] ?? null;
    $stormMoves = $stormMoves[$card->getLocation()] ?? null;
    return $event['pId'] == $card->getPId() && !is_null($stormMoves) && ($stormMoves['moves'] ?? 0) > 0;
  }

  public static function myExpeditionIsBehind($card, $event)
  {
    $winners = Players::getWinningPlayerByStorms();
    $win = $winners[$card->getLocation()];
    return !is_null($win) && $win != -1 && $win != $card->getPId();
  }

  public static function allExpeditionsAreBehindOrTied($card, $event)
  {
    $winners = Players::getWinningPlayerByStorms();
    $left = $winners[STORM_LEFT];
    $right = $winners[STORM_RIGHT];
    return !is_null($left) && !is_null($right) && $left != $card->getPId() && $right != $card->getPId();
  }

  public static function allExpeditionsAreNotBehindOrTied($card, $event)
  {
    return !self::allExpeditionsAreBehindOrTied($card, $event);
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
    return $card
      ->getPlayer()
      ->getHand()
      ->count() > 0;
  }

  public static function hasReserve($card, $event)
  {
    return $card
      ->getPlayer()
      ->getReserveCards()
      ->count() > 0;
  }

  public static function checkReserveCards($card, $event, $n, $op = 'GTE')
  {
    $count = $card
      ->getPlayer()
      ->getReserveCards()
      ->count();
    if ($op == 'GTE') {
      return $count >= $n;
    }
    if ($op == 'LTE') {
      return $count <= $n;
    }
  }

  public static function hasLess8Mana($card, $event)
  {
    return $card->getPlayer()->getTotalMana() < 8;
  }

  public static function hasXMana($card, $event, $n, $op = 'GTE')
  {
    $mana = $card->getPlayer()->getTotalMana();
    if ($op == 'GTE') {
      return $mana >= $n;
    } elseif ($op == 'LTE') {
      return $mana <= $n;
    } elseif ($op == 'LT') {
      return $mana < $n;
    } elseif ($op == 'GT') {
      return $mana > $n;
    }
  }

  public static function hasControl($card, $event, $type, $n, $excludeMyself = 'false', $state = 'all', $op = 'GTE')
  {
    $types = [CHARACTER, TOKEN];
    if ($type == TOKEN) {
      $types = [TOKEN];
    }
    if ($type == PERMANENT) {
      $types = [PERMANENT];
    }
    if (in_array($type, SUBTYPES)) {
      $types = [CHARACTER, TOKEN, PERMANENT];
    }

    $cards = $card->getPlayer()->getPlayedCards($types);

    if (in_array($type, SUBTYPES)) {
      $cards = $cards->filter(fn($c) => in_array($type, $c->getSubtypes()));
    }

    if ($excludeMyself === 'true') {
      $cards = $cards->filter(fn($c) => $c->getId() != $card->getId());
    }

    if ($state != 'all') {
      if ($state == 'boosted') {
        $cards = $cards->filter(fn($c) => $c->hasToken(BOOST));
      } elseif ($state == 'fleeting') {
        $cards = $cards->filter(fn($c) => $c->hasToken(FLEETING));
      }
    }

    $m = $cards->count();
    if ($op == 'GTE') {
      return $m >= $n;
    }
    if ($op == 'LTE') {
      return $m <= $n;
    }
  }

  // Flawed prototype
  public static function noRobotnoPermanent($card, $event)
  {
    $cards = $card->getPlayer()->getPlayedCards();

    $cards = $cards->filter(function ($c) use ($card) {
      if ($c->getId() == $card->getId()) {
        return false;
      }
      if ($c->getType() == PERMANENT || in_array(ROBOT, $c->getSubtypes())) {
        return true;
      }
      return false;
    });
    return $cards->count() == 0;
  }

  public static function noPlantnoPermanent($card, $event)
  {
    $cards = $card->getPlayer()->getPlayedCards();

    $cards = $cards->filter(function ($c) use ($card) {
      if ($c->getId() == $card->getId()) {
        return false;
      }
      if ($c->getType() == PERMANENT || in_array(PLANT, $c->getSubtypes())) {
        return true;
      }
      return false;
    });
    return $cards->count() == 0;
  }

  public static function costCheck($card, $event, $cost, $op = 'GTE')
  {
    $discardedCard = Cards::get($event['cardId']);
    $costHand = $discardedCard->getCostHand();

    if ($op == 'GTE') {
      return $cost <= $costHand;
    }
    if ($op == 'LTE') {
      return $cost >= $costHand;
    }
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

    return $card->getPId() == ($event['pId'] ?? $card->getPId()) && $hasZero >= 3;
  }

  public static function canSacrifice($card, $event)
  {
    return self::hasControl($card, $event, CHARACTER, 1);
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

  public static function hasFleeting($card, $event)
  {
    return $card->hasToken(FLEETING) || ($event['fleeting'] ?? false);
  }

  public static function notTapped($card, $event)
  {
    return !$card->isTapped();
  }

  public static function notUsed($card, $event)
  {
    return ($card->getExtraDatas()['userPower'] ?? false) == false;
  }

  public static function hasBoost($card, $event, $n = 1, $op = 'GTE')
  {
    // USELESS ?? self::isMe($card, $event) &&
    $m = $card->countToken(BOOST);
    // EVENT keep information about the card previous status in case it was move to discard
    if (isset($event['boost'])) {
      $m = $event['boost'];
    }

    if ($op == 'GTE') {
      return $m >= $n;
    }
    if ($op == 'LTE') {
      return $m <= $n;
    }
    die('Unknown op for hasBoost');
  }

  public static function hasCounterOnCard($card, $event, $n = 1, $op = 'GTE')
  {
    $m = $card->getExtraDatas()['counter'] ?? 0;
    if ($op == 'GTE') {
      return $m >= $n;
    }
    if ($op == 'LTE') {
      return $m <= $n;
    }
    die('Unknown op for hasCounterOnCard');
  }

  public static function hasGainedBoost($card, $event, $n = 1)
  {
    return self::hasGained($card, $event, BOOST, $n);
  }

  public static function hasGained($card, $event, $type, $n = 1)
  {
    if (($event['action'] ?? null) != GAIN) {
      return false;
    }
    if ($event['gain']['cardId'] != $card->getId()) {
      return false;
    }

    if ($event['gain']['type']  != $type) {
      return false;
    }

    return true;
  }

  public static function hasGainedFleeting($card, $event)
  {
    if (($event['action'] ?? null) != GAIN) {
      return false;
    }

    if (Cards::get($event['gain']['cardId'])->getPId() != $card->getPId()) {
      return false;
    }

    if (!in_array(Cards::get($event['gain']['cardId'])->getType(), [TOKEN, CHARACTER])) {
      return false;
    }

    if ($event['gain']['type']  != FLEETING) {
      return false;
    }

    return true;
  }

  public static function isPlayedInSameLocation($card, $event)
  {
    // TODO: manage gigantic
    return $card->getLocation() == ($event['to'] ?? '');
  }

  /////////////////////////////////////////////////////////////
  //   ____  _                      _    ____              _
  //  |  _ \| | __ _ _   _  ___  __| |  / ___|__ _ _ __ __| |
  //  | |_) | |/ _` | | | |/ _ \/ _` | | |   / _` | '__/ _` |
  //  |  __/| | (_| | |_| |  __/ (_| | | |__| (_| | | | (_| |
  //  |_|   |_|\__,_|\__, |\___|\__,_|  \____\__,_|_|  \__,_|
  //                 |___/
  /////////////////////////////////////////////////////////////

  public static function isAddedCardEvent($card, $event, $playedOnly = false)
  {
    if (!($event['playCard'] ?? false)) {
      return false;
    }

    if (!self::isMe($card, $event)) {
      return false;
    }

    // Distinguish play and put
    if ($playedOnly && ($event['putAndNotPlayed'] ?? false)) {
      return false;
    }

    return true;
  }

  public static function isCardAdded($card, $event, $type, $cost = null, $op = 'GTE', $excludeMyself = '', $playedOnly = false)
  {
    if (!self::isAddedCardEvent($card, $event)) {
      return false;
    }

    $playedCard = Cards::get($event['cardId']);

    // Exclude myself
    if ($excludeMyself == 'true' && $card->getId() == $event['cardId']) {
      return false;
    }

    // Type check
    if (!self::typeCheck($type, $event['cardType'])) {
      return false;
    }

    // Subtype check
    if (in_array($type, SUBTYPES)) {
      if (!in_array($type, $playedCard->getSubtypes())) {
        return false;
      }
    }

    // Cost check
    if (!is_null($cost)) {
      $costHand = $playedCard->getCostHand();
      if ($op == 'GTE' && $costHand < $cost) {
        return false;
      }
      if ($op == 'LTE' && $costHand > $cost) {
        return false;
      }
      if ($op == 'E' && $costHand != $cost) {
        return false;
      }
    }

    return true;
  }

  public static function isCardPlayed($card, $event, $type, $cost = null, $op = 'GTE', $excludeMyself = '')
  {
    return self::isCardAdded($card, $event, $type, $cost, $op, $excludeMyself, true);
  }

  public static function isCardPlayedWithZeroStat($card, $event)
  {
    if (!self::isCardPlayed($card, $event, CHARACTER)) {
      return false;
    }

    $playedCard = Cards::get($event['cardId']);
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
    $additionalEffect = false;

    foreach ($event['additionalEffects'] as $addEffect) {
      if ($addEffect['type'] == $event['cardType']) {
        $additionalEffect = true;
      }
    }

    return ($event['from'] == RESERVE || $additionalEffect) &&
      !Players::hasOpponentBlockingPower($card->getPlayer(), $event['to']);
  }

  public static function isCharacterCostHigherThanCounter($card, $event)
  {
    if (!self::isCardPlayed($card, $event, CHARACTER)) {
      return false;
    }

    $cardPlayed = Cards::get($event['cardId']);
    return ($event['playedFree'] ?? false) == false && $cardPlayed->getCostHand() >= ($card->getExtraDatas()['counter'] ?? 0);
  }

  public static function specialEffect($card, $event, $effect)
  {
    return ($event['specialEffect'] ?? '') == $effect;
  }


  //////////////////////////////////////////////////////////////////////////
  //  ____  _                       _          _    ____              _ 
  // |  _ \(_)___  ___ __ _ _ __ __| | ___  __| |  / ___|__ _ _ __ __| |
  // | | | | / __|/ __/ _` | '__/ _` |/ _ \/ _` | | |   / _` | '__/ _` |
  // | |_| | \__ \ (_| (_| | | | (_| |  __/ (_| | | |__| (_| | | | (_| |
  // |____/|_|___/\___\__,_|_|  \__,_|\___|\__,_|  \____\__,_|_|  \__,_|
  //////////////////////////////////////////////////////////////////////////
  // WARNING: 'Discard' has a very large meaning, any card moving and not going to the expedition or landmark is considered to being discarded

  public static function isDiscardedEvent($card, $event, $meOnly = false)
  {
    if (!($event['discardCard'] ?? false)) {
      return false;
    }

    if ($meOnly && !self::isMe($card, $event)) {
      return false;
    }

    return true;
  }

  public static function isDiscarded($card, $event, $from = null, $to = null, $type = null)
  {
    if (!self::isDiscardedEvent($card, $event)) {
      return false;
    }

    if (!is_null($from) && $from != $event['from']) {
      return false;
    }
    if (!is_null($to) && $to != $event['to']) {
      return false;
    }

    if (!is_null($type)) {
      $discardedCard = Cards::get($event['cardId']);
      if (!self::typeCheck($type, $discardedCard->getType())) {
        return false;
      }
    }

    return true;
  }

  public static function isMyselfDiscarded($card, $event, $from = null, $to = null)
  {
    return $event['cardId'] == $card->getId() && self::isDiscarded($card, $event, $from, $to);
  }

  public static function notDiscarded($card, $event)
  {
    return $event['cardId'] == $card->getId()  && ($event['to'] ?? '') == RESERVE;
  }

  public static function isSacrifice($card, $event, $type = null)
  {
    if (!($event['sacrifice'] ?? false)) {
      return false;
    }

    // Type check if needed
    if (!is_null($type)) {
      $discardedCard = Cards::get($event['cardId']);
      if (!self::typeCheck($type, $discardedCard->getType())) {
        return false;
      }
    }

    return true;
  }

  public static function isSacrificed($card, $event)
  {
    return self::isSacrifice($card, $event) && self::isMyselfDiscarded($card, $event);
  }

  ///////////////////////////////////
  //   ___  _   _                   
  //  / _ \| |_| |__   ___ _ __ ___ 
  // | | | | __| '_ \ / _ \ '__/ __|
  // | |_| | |_| | | |  __/ |  \__ \
  //  \___/ \__|_| |_|\___|_|  |___/
  ///////////////////////////////////

  // Quezalcoatl
  public static function isOpponentDraw($card, $event)
  {
    return self::isNotMe($card, $event) && ($event['location'] ?? null) != MANA;
  }

  public static function realResupply($card, $event)
  {
    return ($event['notResupply'] ?? false) == false;
  }


  public static function isHandEmpty($card, $event)
  {
    return $card->getPlayer()->getHand()->count() == 0;
  }

  public static function isReserveEmpty($card, $event)
  {
    return $card->getPlayer()->getReserveCards()->count() == 0;
  }

  public static function isInBiome($card, $event, $biome)
  {
    return $card->getPlayer()->isInBiome($card->getLocation(), $biome);
  }
  public static function isNotInBiome($card, $event, $biome)
  {
    return !self::isInBiome($card, $event, $biome);
  }

  public static function isInBiomeWithZeroStat($card, $event)
  {
    if (!self::isCardPlayedWithZeroStat($card, $event)) {
      return false;
    }

    $playedCard = Cards::get($event['cardId']);
    $hasZero = false;
    foreach ($playedCard->getBiomes() as $biome => $value) {
      if ($value == 0 && self::isInBiome($card, $event, $biome)) {
        return true;
      }
    }
    return false;
  }

  /**********************************
   **********************************
   ************* HELPERS ************
   **********************************
   *********************************/

  public static function typeCheck($type, $cardType)
  {
    if (in_array($type, [PERMANENT, TOKEN, SPELL])) {
      if ($cardType != $type) {
        return false;
      }
    }
    if ($type == CHARACTER && !in_array($cardType, [CHARACTER, TOKEN])) {
      return false;
    }
    if ($type == 'characterOnly' && $cardType != CHARACTER) {
      return false;
    }

    return true;
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
}
