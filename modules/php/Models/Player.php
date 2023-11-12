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

  public function getUiData($currentPlayerId = null)
  {
    $data = parent::getUiData();
    $current = $this->id == $currentPlayerId;
    $data['deckCount'] = $this->getDeckCount();
    $data['mana'] = $this->getMana();
    $data['totalMana'] = $this->getTotalMana();
    $data['hand'] = $current ? $this->getHand()->ui() : [];
    $data['handCount'] = $this->getHand()->count();
    $data['biomes'] = $this->getBiomeStrength();

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

  public function draw($nb, $fromLocation = null, $toLocation = null, $source = null, $publicMsg = null, $privateMsg = null)
  {
    $fromLocation = $fromLocation ?? 'deck-' . $this->id;
    $toLocation = $toLocation ?? 'hand';
    $public = $toLocation == 'hand' ? false : true;
    $cards = Cards::pickForLocation($nb, $fromLocation, $toLocation);
    if ($source !== null) {
      Notifications::drawCards(
        $this,
        $cards,
        $publicMsg ?? clienttranslate('You draw ${card_names} from your deck (${card_name2}\'s effect)'),
        $privateMsg ??
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

  public function payMana($n, $notif = true, $source = null)
  {
    $cards = $this->getManaCards(false)->limit($n);
    if ($cards->count() < $n) {
      throw new \BgaVisibleSystemException('You don\'t have enough money to pay. Should not happen');
    }

    foreach ($cards as $card) {
      $card->setTapped(true);
    }
    // if ($notif) {
    //   Notifications::payMana($this, $n, $this->getMana(), $source);
    // }
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

  public function getPermanentSlots()
  {
    return $this->getHero()->getPermanentSlots();
  }

  public function getPermanents()
  {
    return Cards::getPlayedCards($this->id, PERMANENT);
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

  public function checkVictory()
  {
    $companionPos = explode('-', $this->getCompanionToken()->getLocation())[1];
    $heroPos = explode('-', $this->getHeroToken()->getLocation())[1];
    return [$companionPos - $heroPos <= 0, Globals::getStormMoves()[$this->id] ?? 0];
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

  public function advanceStorm($token, $biome)
  {
    $getToken = 'get' . ucfirst($token) . 'Token';
    $tokenMeeple = $this->$getToken();
    // TODO: manage immobile
    $location = $tokenMeeple->getLocationArg();
    // if hero we increase
    $delta = $token == HERO ? 1 : -1;
    $sId = $location + $delta;
    // Set new location
    $tokenMeeple->setLocation('storm-' . $sId);

    // needed to determine if tiebreaker is needed
    $moves = Globals::getStormMoves();
    $moves[$this->id] = $moves[$this->id] ?? 0 + 1;
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

    Notifications::moveStormToken($this, $biome, $tokenMeeple, $stormIndex, $revealed);
  }

  public function nightCleanup()
  {
    $deletedCards = new Collection();
    $deletedCardTokens = new Collection();
    $deletedTokens = [];
    $cleanupCards = [];
    $movedToReserve = [];

    foreach ($this->getPlayedCards() as $cId => $card) {
      if ($card->getType() == PERMANENT) {
        continue;
      }

      // Remove card if Fleeting but is not anchored
      if ($card->hasToken(FLEETING) && !$card->hasToken(ANCHORED)) {
        $deletedTokens = array_merge($deletedTokens, $card->discard()->getIds());
        $deletedCards[$cId] = $card;
        continue;
      }

      // Move card without anchored,asleep to reserve
      if (!$card->hasToken(ANCHORED) && !$card->hasToken(ASLEEP)) {
        // move card to reserve
        $deletedTokens = array_merge($deletedTokens, $card->moveToReserve());
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
      $deletedTokens = array_merge($deletedTokens, $card->nightCleanup());
      $cleanupCards[] = $cId;
    }
    // throw new \feException(print_r($deletedTokens));
    Notifications::nightCleanup($this, $deletedCards, $deletedTokens, Cards::getMany($movedToReserve), $deletedCardTokens);
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

    foreach ($expeditions as $i => $exp) {
      $strength = [OCEAN => 0, MOUNTAIN => 0, FOREST => 0]; // OCEAN/MOUNTAIN/FOREST
      foreach ($cards as $c => $card) {
        if ($card->getLocation() != $exp && !$card->hasToken(GIGANTIC) && !$card->isGigantic()) {
          continue;
        }

        $biome = $card->getBiomes($includeModifiers);
        foreach ($biome as $bi => $value) {
          $strength[$bi] += $value;
        }
      }
      $strengths[$exp] = $strength;
    }
    return $strengths;
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
}
