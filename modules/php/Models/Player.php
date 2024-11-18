<?php

namespace ALT\Models;

use ALT\Core\Stats;
use ALT\Core\Notifications;
use ALT\Core\Preferences;
use ALT\Managers\Actions;
use ALT\Managers\Cards;
use ALT\Managers\Meeples;
use ALT\Core\Globals;
use ALT\Core\Engine;
use ALT\Helpers\Collection;
use ALT\Helpers\Conditions;
use ALT\Helpers\Utils;
use ALT\Managers\Players;

/*
 * Player: all utility functions concerning a player
 */

class Player extends \ALT\Helpers\DB_Model
{
  private $map = null;
  protected $table = 'player';
  protected $primary = 'player_id';
  protected $attributes = [
    'id' => ['player_id', 'int'],
    'no' => ['player_no', 'int'],
    'name' => 'player_name',
    'color' => 'player_color',
    'eliminated' => 'player_eliminated',
    'score' => ['player_score', 'int'],
    'scoreAux' => ['player_score_aux', 'int'],
    'zombie' => 'player_zombie',
    'faction' => 'faction',
  ];
  protected $id;

  public function getUiData($currentPlayerId = null)
  {
    $data = parent::getUiData();
    $current = $this->id == $currentPlayerId;
    $data['deckCount'] = $this->getDeckCount();
    $data['mana'] = $this->getMana();
    $data['totalMana'] = $this->getTotalMana();
    $data['handCount'] = $this->getHand()->count();
    $data['hand'] = $current ? $this->getHand()->ui() : [];
    $data['manaCards'] = $current ? $this->getManaCards() : [];
    return $data;
  }

  public function getDeckCount()
  {
    return Cards::countInLocation("deck-$this->id");
  }

  public function getHero()
  {
    $pId = $this->id;
    return Cards::getInLocation("board-hero-$pId")->first();
  }

  public function getHeroCollection()
  {
    $pId = $this->id;
    return Cards::getInLocation("board-hero-$pId");
  }

  public function getPref($prefId)
  {
    return Preferences::get($this->id, $prefId);
  }

  public function getStat($name)
  {
    $name = 'get' . \ucfirst($name);
    return Stats::$name($this->id);
  }

  public function canTakeAction($action, $ctx)
  {
    return Actions::isDoable($action, $ctx, $this);
  }

  public function draw(
    $nb,
    $fromLocation = null,
    $toLocation = null,
    $source = null,
    $publicMsg = null,
    $privateMsg = null,
    $tapped = false
  ) {
    $fromLocation = $fromLocation ?? 'deck-' . $this->id;
    $toLocation = $toLocation ?? 'hand';
    $public = $toLocation == 'hand' ? false : true;
    $cards = Cards::pickForLocation($nb, $fromLocation, $toLocation);
    if ($tapped == true) {
      foreach ($cards as $cId => $card) {
        $card->setTapped(true);
      }
    }
    if ($toLocation == MANA) {
      Notifications::discardMana($this, $cards, $privateMsg, $publicMsg, ['card2' => $source, 'fromLocation' => $fromLocation]);
    } elseif ($source !== null) {
      Notifications::drawCards(
        $this,
        $cards,
        $privateMsg ?? clienttranslate('You draw ${card_names} from your deck (${card_name2}\'s effect)'),
        $publicMsg ??
          ($public
            ? clienttranslate('${player_name} draws ${card_names} from its deck (${card_name2}\'s effect)')
            : clienttranslate('${player_name} draws ${n} card(s) from its deck (${card_name2}\'s effect)')),
        ['card2' => $source],
        $public
      );
    } else {
      Notifications::drawCards($this, $cards, null, null, [], $public);
    }
    return $cards;
  }

  ////////////////////////////////////////
  //  ____       _   _
  // / ___|  ___| |_| |_ ___ _ __ ___
  // \___ \ / _ \ __| __/ _ \ '__/ __|
  //  ___) |  __/ |_| ||  __/ |  \__ \
  // |____/ \___|\__|\__\___|_|  |___/
  ////////////////////////////////////////

  public function payMana($n)
  {
    $cards = $this->getManaCards(false)->limit($n);
    if ($cards->count() < $n) {
      throw new \BgaVisibleSystemException('You don\'t have enough mana to pay. Should not happen');
    }

    foreach ($cards as $card) {
      $card->setTapped(true);
    }
  }

  ///////////////////////////////////////////////////
  //    ____              _
  //   / ___|__ _ _ __ __| |___
  //   | |   / _` | '__/ _` / __|
  //   | |__| (_| | | | (_| \__ \
  //   \____\__,_|_|  \__,_|___/
  ///////////////////////////////////////////////////
  public function getHand($type = null)
  {
    return Cards::getHand($this->id)->filter(function ($card) use ($type) {
      return is_null($type) || $card->getType() == $type;
    });
  }

  // public function getManaChoice()
  // {
  //   return Cards::getManaChoice($this->id);
  // }

  public function getPlayedCards($type = null)
  {
    return Cards::getPlayedCards($this->id, $type);
  }

  public function countCardsInLocation($location, $types)
  {
    return $this->getPlayedCards()->filter(function ($c) use ($location, $types) {
      return $c->getLocation() == $location && in_array($c->getType(), $types);
    })->count();
  }

  public function hasPlayedCard($id)
  {
    return Cards::hasPlayedCard($this->id, $id);
  }

  public function getReserveCards()
  {
    return Cards::getReserveCards($this->id);
  }

  public function getReserveSlots()
  {
    return $this->getHero()->getReserveSlots();
  }

  public function getLandmarkSlots()
  {
    return $this->getHero()->getLandmarkSlots();
  }

  public function getPermanents()
  {
    return Cards::getPlayedCards($this->id, PERMANENT);
  }

  public function getLandmarks()
  {
    return Cards::getPlayedCards($this->id, PERMANENT)->where('subtypes', LANDMARK);
  }

  public function getManaCards($tapped = null)
  {
    return Cards::getFiltered($this->id, MANA)->filter(function ($card) use ($tapped) {
      return is_null($tapped) || ($tapped === true && $card->isTapped()) || ($tapped === false && !$card->isTapped());
    });
  }

  public function getMana()
  {
    return $this->getManaCards(false)->count();
  }

  public function getTotalMana()
  {
    return $this->getManaCards()->count();
  }

  public function getStormToken($type)
  {
    return Meeples::getStormTokens($this->id)
      ->filter(function ($m) use ($type) {
        return $m->getType() == $type;
      })
      ->first();
  }

  public function getCompanionToken()
  {
    return $this->getStormToken(COMPANION);
  }

  public function getHeroToken()
  {
    return $this->getStormToken(HERO);
  }

  public function getDeck($deckNumber)
  {
    return Cards::getFiltered($this->id, 'deck-' . $deckNumber)->merge(
      Cards::getFiltered($this->id, 'board-hero-' . $deckNumber)
    );
  }

  public function getAddRoll()
  {
    $add = 0;
    foreach ($this->getPlayedCards() as $cId => $card) {
      $add += $card->getAddRoll();
    }
    return $add;
  }

  public function getAddDice()
  {
    $add = 0;
    foreach ($this->getPlayedCards() as $cId => $card) {
      $add += $card->getAddDice();
    }
    return $add;
  }

  public function getResupply2()
  {
    foreach ($this->getPlayedCards() as $cId => $card) {
      if ($card->getResupply2()) {
        return true;
      }
    }
    return false;
  }

  public function getExhaustedReserveSlots()
  {
    $slots = 0;
    foreach ($this->getPlayedCards() as $cId => $card) {
      $slots += $card->getExhaustedReserveSlots();
    }
    return $slots;
  }

  public function getRegionDifference()
  {
    if (is_null($this->getCompanionToken())) {
      return 7;
    }
    $companionPos = explode('-', $this->getCompanionToken()->getLocation())[1];
    $heroPos = explode('-', $this->getHeroToken()->getLocation())[1];
    return max($companionPos - $heroPos, 0);
  }

  public function checkVictory()
  {
    if (is_null($this->getCompanionToken())) {
      return 7;
    }
    $companionPos = explode('-', $this->getCompanionToken()->getLocation())[1];
    $heroPos = explode('-', $this->getHeroToken()->getLocation())[1];
    return [$companionPos - $heroPos <= 0, $heroPos + (7 - $companionPos)];
  }

  public function getBiomeInStorms()
  {
    $tokens = Meeples::getStormTokens($this->id);
    $locations = [];
    $storms = Globals::getStorm();

    foreach ($tokens as $i => $token) {
      $sId = $token->getLocationArg();

      if ($sId == 0 || $sId == 7) {
        $locations[$token->getType()] = [FOREST, MOUNTAIN, OCEAN];
        continue;
      }

      $card = $storms[intdiv($sId + 1, 2)];
      $storm = STORM_CARDS[$card['cardId']];

      if ($card['rotated']) {
        $storm = array_reverse($storm);
      }
      $sId--;
      $locations[$token->getType()] = $storm[$sId % 2];
    }
    return $locations;
  }

  public function isInBiome($storm, $biome)
  {
    $biomes = $this->getBiomeInStorms();
    $expedition = $storm == STORM_LEFT ? HERO : COMPANION;
    $newBiomes = [];
    foreach ($biomes[$expedition] as $b) {
      $newBiomes[$b] = $b;
    }
    Players::biomesModifier($newBiomes, $this, $expedition);
    return in_array($biome, $newBiomes);
  }

  public function advanceStorm($token, $biomes, $n = 1, $notify = true, $source = null)
  {
    $getToken = 'get' . ucfirst($token) . 'Token';
    $tokenMeeple = $this->$getToken();
    // TODO: manage immobile
    $location = $tokenMeeple->getLocationArg();
    $expedition = $token == HERO ? STORM_LEFT : STORM_RIGHT;



    // if hero we increase
    $delta = $token == HERO ? $n : $n * -1;
    $sId = $token == HERO ? max(0, $location + $delta) : min(7, $location + $delta);

    if ($sId == $location) {
      Notifications::message(clienttranslate('${player_name} expedition cannot move'), ['player' => $this]);
      return;
    }

    // Set new location
    $tokenMeeple->setLocation('storm-' . $sId);

    // needed to effect after moving
    $moves = Globals::getStormMoves();
    $moves[$this->id][$expedition] = [
      'biomes' => is_array($biomes) ? $biomes : [],
      'moves' => $n,
    ];
    Globals::setStormMoves($moves);

    // Do we need to reveal storm?
    $revealed = null;
    $storms = Globals::getStorm();
    $stormIndex = intdiv($sId + 1, 2);
    if (!$storms[$stormIndex]['visible']) {
      $storms[$stormIndex]['visible'] = true;
      $revealed = $storms[$stormIndex];
      Globals::setStorm($storms);
    }

    if ($notify) {
      Notifications::moveStormToken($this, $biomes, $tokenMeeple, $stormIndex, $revealed, $source);
    }
  }

  public function nightCleanup()
  {
    $deletedCards = new Collection();
    $deletedCardTokens = new Collection();
    $deletedMeepleIds = [];
    $cleanupCards = [];
    $movedToReserve = [];

    foreach ($this->getPlayedCards() as $cId => $card) {
      if (in_array(LANDMARK, $card->getSubtypes())) {
        continue;
      }

      // Expedition, if the player hasn't moved, it stays
      if (in_array(EXPEDITION, $card->getSubtypes())) {
        $moves = Globals::getStormMoves();
        if (!isset($moves[$this->id]) || !isset($moves[$this->id][$card->getLocation()]) || $moves[$this->id][$card->getLocation()]['moves'] < 1) {
          continue;
        }
      }

      // Remove card if Fleeting but is not anchored
      if ($card->hasToken(FLEETING) && !$card->hasToken(ANCHORED) && !$card->hasToken(ASLEEP) && !$card->isEternal()) {
        $deletedMeepleIds = array_merge($deletedMeepleIds, $card->discard());
        $deletedCards[$cId] = $card;
        continue;
      }



      // Move card without anchored,asleep to reserve
      if (!$card->hasToken(ANCHORED) && !$card->hasToken(ASLEEP) && !$card->isEternal()) {
        // move card to reserve
        $deletedMeepleIds = array_merge($deletedMeepleIds, $card->moveToReserve());
        if ($card->isToken()) {
          // delete the card as it's a token
          $deletedCardTokens[] = $card;
          Cards::delete($cId);
        } else {
          $movedToReserve[] = $cId;
        }
        continue;
      }

      // Remove Anchored / Asleep tokens
      $deletedMeepleIds = array_merge($deletedMeepleIds, $card->nightCleanup());
      $cleanupCards[] = $cId;
    }

    Notifications::nightCleanup($this, $deletedCards, $deletedMeepleIds, Cards::getMany($movedToReserve), $deletedCardTokens);
    if (!empty($cleanupCards)) {
      Notifications::cleanupCards($this, $cleanupCards);
    }

    return array_merge($deletedCards->getIds(), $movedToReserve);
  }

  /************** Expedition calculation *******/
  public function getBiomeStrength($expeditions = STORMS, $includeModifiers = true)
  {
    $strengths = [];
    $cards = $this->getPlayedCards();
    $validBiomes = [FOREST => 0, OCEAN => 0, MOUNTAIN => 0];

    if (Globals::isTieBreakerMode()) {
      Players::biomesModifier($validBiomes, $this, '', true);
    }

    foreach ($expeditions as $i => $exp) {
      $strength = [OCEAN => 0, MOUNTAIN => 0, FOREST => 0]; // OCEAN/MOUNTAIN/FOREST
      $increaseBiomesToHighest = $this->hasIncreaseBiomesHighest($exp);
      foreach ($cards as $c => $card) {
        if ($card->getLocation() != $exp && !$card->hasToken(GIGANTIC) && !$card->isGigantic()) {
          continue;
        }
        if ($card->hasToken(ASLEEP)) {
          continue;
        }

        $biome = $card->getBiomes($includeModifiers, $increaseBiomesToHighest);
        foreach ($biome as $bi => $value) {
          $strength[$bi] += $value;
        }
      }
      foreach ($strength as $biome => $s) {
        if (!isset($validBiomes[$biome])) {
          $strength[$biome] = 0;
        }
      }
      $strengths[$exp] = $strength;
    }



    return $strengths;
  }

  public function hasBlockingPower($expedition)
  {
    foreach ($this->getPlayedCards()->where('location', $expedition) as $cId => $card) {
      if ($card->isBlockingPower()) {
        return true;
      }
    }
    return false;
  }

  public function hasIncreaseBiomesHighest($expedition)
  {
    foreach ($this->getPlayedCards()->where('location', $expedition) as $cId => $card) {
      if ($card->isIncreaseBiomesHighest()) {
        return true;
      }
    }
    return false;
  }

  public function hasAdvanceTwiceDusk($expedition)
  {
    foreach ($this->getPlayedCards()->where('location', $expedition) as $cId => $card) {
      if ($card->isAdvanceTwiceDusk()) {
        return true;
      }
    }
    return false;
  }

  public function hasOppositeDefender($expedition)
  {
    foreach ($this->getPlayedCards()->where('location', $expedition) as $cId => $card) {
      if ($card->isOppositeDefender()) {
        return true;
      }
    }
    return false;
  }

  public function canPlayTappedCards($type = null, $location = null)
  {
    foreach ($this->getPlayedCards() as $cId => $card) {
      $playTap = $card->getPlayTappedCards();
      if (is_null($playTap) || empty($playTap)) {
        continue;
      }
      // for all cards
      if ($playTap['type'] == 'all') {
        return true;
      }
      // location check
      if (isset($playTap['location']) && !is_null($location)) {
        if ($location != $card->getLocation()) {
          continue;
        }
      }

      if (!is_null($type) && $playTap['type'] == $type) {
        return true;
      }
    }
    return false;
  }

  public function getOpponentAdditionalCost($type)
  {
    $f = 'getIncreaseOpponent' . ucfirst($type) . 'Cost';
    $cost = 0;
    foreach ($this->getPlayedCards() as $cId => $card) {
      $penalty = $card->$f();
      if (is_int($penalty)) {
        $cost += $card->$f();
      } else {
        if (!is_null(Utils::checkAttributeCondition('tough', $penalty, $this, $card))) {
          $cost += (int) explode(':', $card->$f())[0];
        }
      }

      $penalties =  $card->getIncreaseOpponentCardsCost();
      if (!is_array($penalties)) {
        $penalties = [$penalties];
      }
      foreach ($penalties as $penalty) {
        if (is_int($penalty)) {
          $cost += $penalty;
        } else {
          if (!is_null(Utils::checkAttributeCondition('tough', $penalty, $this, $card))) {
            $cost += (int) explode(':', $penalty)[0];
          }
        }
      }
    }
    return $cost;
  }

  public function getOpponentMinimumCost($type)
  {
    $cost = 0;
    foreach ($this->getPlayedCards() as $cId => $card) {
      if ($type == CHARACTER) {
        $penalty = $card->getOpponentCharactersMinimumCost();
        if (is_int($penalty)) {
          $cost = max($cost, $card->getOpponentCharactersMinimumCost());
        } else {
          if (!is_null(Utils::checkAttributeCondition('tough', $penalty, $this, $card))) {
            $cost = max($cost, (int) explode(':', $card->getOpponentCharactersMinimumCost())[0]);
          }
        }
      }

      $penalties =  $card->getOpponentCardsMinimumCost();
      if (!is_array($penalties)) {
        $penalties = [$penalties];
      }
      foreach ($penalties as $penalty) {
        if (is_int($penalty)) {
          $cost = max($cost, $penalty);
        } else {
          if (!is_null(Utils::checkAttributeCondition('tough', $penalty, $this, $card))) {
            $cost = max($cost, (int) explode(':', $penalty)[0]);
          }
        }
      }
    }
    return $cost;
  }

  /********* Deck setup ***********/
  public function initializeDecks()
  {
    $i = 0;
    $decks = [];
    // call the API to get the various cards/decks

    // Add the preconstructed decks last
    $decks = array_merge($decks, Cards::setupPrecoDeck($this, $i, $decks));
    $allDecks = Globals::getPlayerDecks();
    $allDecks[$this->id] = $decks;
    Globals::setPlayerDecks($allDecks);
  }


  public function countUniversalCharacterTough()
  {
    return count(
      $this->getPlayedCards()->filter(function ($card) {
        return Utils::checkAttributeCondition('tough', $card->getDynamicTough(), $this, $card) == 'universalCharacter2';
      })
    ) * 2 + count(
      $this->getPlayedCards()->filter(function ($card) {
        return Utils::checkAttributeCondition('tough', $card->getDynamicTough(), $this, $card) == 'universalCharacter1';
      })
    );
  }

  public function countUniversalTokenGigantic()
  {
    return count(
      $this->getPlayedCards()->filter(function ($card) {
        return $card->getDynamicGigantic() == 'universalGiganticToken';
      })
    );
  }
}
