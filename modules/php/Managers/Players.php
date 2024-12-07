<?php

namespace ALT\Managers;

use ALT\Core\Game;
use ALT\Core\Globals;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Helpers\Collection;
use ALT\Managers\Meeples;
use ALT\Core\Notifications;

/*
 * Players manager : allows to easily access players ...
 *  a player is an instance of Player class
 */

class Players extends \ALT\Helpers\CachedDB_Manager
{
  protected static $table = 'player';
  protected static $primary = 'player_id';
  protected static $datas = null;
  protected static function cast($row)
  {
    return new \ALT\Models\Player($row);
  }

  public static function setupNewGame($players, $options)
  {
    // Create players
    $gameInfos = Game::get()->getGameinfos();
    $colors = $gameInfos['player_colors'];
    $query = self::DB()->multipleInsert([
      'player_id',
      'player_color',
      'player_canal',
      'player_name',
      'player_avatar',
      'player_score',
    ]);

    $values = [];

    foreach ($players as $pId => $player) {
      $color = array_shift($colors);
      $values[] = [
        $pId,
        $color,
        $player['player_canal'],
        $player['player_name'],
        $player['player_avatar'],
        0,
      ];
    }
    $query->values($values);
    Game::get()->reattributeColorsBasedOnPreferences($players, $gameInfos['player_colors']);
    Game::get()->reloadPlayersBasicInfos();
    self::invalidate();
  }

  public static function getActiveId()
  {
    return (int) Game::get()->getActivePlayerId();
  }

  public static function getCurrentId()
  {
    return (int) Game::get()->getCurrentPId();
  }

  /*
   * get : returns the Player object for the given player ID
   */
  public static function get($id = null)
  {
    return parent::get($id ?? self::getActiveId());
  }

  public static function getActive()
  {
    return self::get();
  }

  public static function getCurrent()
  {
    return self::get(self::getCurrentId());
  }

  public static function getNextId($player)
  {
    $pId = is_int($player) ? $player : $player->getId();
    $table = Game::get()->getNextPlayerTable();
    return $table[$pId];
  }

  public static function getNext($player)
  {
    return self::get(self::getNextId($player));
  }

  public static function getPrevious($player)
  {
    $table = Game::get()->getPrevPlayerTable();
    $pId = (int) $table[$player->getId()];
    return self::get($pId);
  }

  /*
   * Return the number of players
   */
  public static function count()
  {
    return self::getAll()->count();
  }

  /*
   * getUiData : get all ui data of all players
   */
  public static function getUiData($pId)
  {
    return self::getAll()
      ->map(function ($player) use ($pId) {
        return $player->getUiData($pId);
      })
      ->toAssoc();
  }

  /*
   * Get current turn order according to first player variable
   */
  public static function getTurnOrder($firstPlayer = null)
  {
    $firstPlayer = $firstPlayer ?? Globals::getFirstPlayer();
    $order = [];
    $p = $firstPlayer;
    do {
      $order[] = $p;
      $p = self::getNextId($p);
    } while ($p != $firstPlayer);
    return $order;
  }

  public static function getPowersBlockedExpeditions()
  {
    $statuses = [];
    foreach (self::getAll() as $pId => $player) {
      foreach (STORMS as $expedition) {
        $statuses[$pId][$expedition] = self::hasOpponentBlockingPower($player, $expedition);
      }
    }

    return $statuses;
  }

  public static function hasOpponentBlockingPower($player, $expedition)
  {
    // TODO: manage multiplayers
    foreach (self::getAll() as $pId => $player2) {
      if ($pId == $player->getId()) {
        continue;
      }
      if ($player2->hasBlockingPower($expedition)) {
        return true;
      }
    }
    return false;
  }

  public static function hasOppositeDefender($expedition)
  {
    $oppositeExpedition = $expedition == STORM_LEFT ? STORM_RIGHT : STORM_LEFT;
    foreach (self::getAll() as $pId => $player) {
      if ($player->hasOppositeDefender($oppositeExpedition)) {
        return true;
      }
    }
    return false;
  }

  public static function getOpponentAdditionalCost($player, $type)
  {
    $cost = 0;
    foreach (self::getAll() as $pId => $player2) {
      if ($pId == $player->getId()) {
        continue;
      }
      $cost += $player2->getOpponentAdditionalCost($type);
    }
    return $cost;
  }

  public static function getOpponentMinimumCost($player, $type)
  {
    $cost = 0;
    foreach (self::getAll() as $pId => $player2) {
      if ($pId == $player->getId()) {
        continue;
      }
      $cost = max($cost, $player2->getOpponentMinimumCost($type));
    }
    return $cost;
  }

  public static function checkVictory()
  {
    $isVictory = false;
    $maxMoves = 0;
    $tiebreaker = false;
    $victor = -1;
    // TODO: multiplayer mode
    if (Globals::getTieBreakerMode() === true) {
      return false;
    }

    // check if one or multiple players crossed their tokens
    foreach (Players::getAll() as $pId => $player) {
      list($vic, $moves) = $player->checkVictory();
      if ($vic === true) {
        if ($moves > $maxMoves) {
          $victor = $pId;
          $maxMoves = $moves;
          $tiebreaker = false;
          $isVictory = true;
        } elseif ($moves == $maxMoves) {
          $tiebreaker = true;
          $isVictory = true;
        }
      }
    }

    // players have moved the same number in the phase
    if ($tiebreaker === true) {
      Globals::setTieBreakerMode(true);
      $meeples = new Collection();
      foreach (Players::getAll() as $pId => $player) {
        $player->getCompanionToken()->setLocation('storm-4');
        $player->getHeroToken()->setLocation('storm-3');
        $meeples = $meeples->merge(Meeples::getStormTokens($pId));
      }
      // notif startTiebreak
      Notifications::startTiebreak($meeples->toArray());
    } elseif ($victor != -1) {
      // we have a winner => end of game
      Players::get($victor)->setScore(1);
      Stats::setWinner(Players::get($victor), 1);
      Stats::setGameWinner(Players::get($victor)->getHero()->getStatData());
      Game::get()->jumpToOrCall(ST_PRE_END_OF_GAME);
      return true;
    }

    return false;
  }

  public static function initializeDecks()
  {
    foreach (self::getAll() as $pId => $player) {
      $player->initializeDecks();
    }
  }

  public static function getBiomeTotals()
  {
    $biomes = [];
    foreach (self::getAll() as $pId => $player) {
      $biomes[$pId] = $player->getBiomeStrength();
    }

    return $biomes;
  }

  public static function getDefenders($onlyDefenders = true)
  {
    $defenders = [];
    $ignoreDefenders = [];
    foreach (self::getAll() as $pId => $player) {
      foreach ($player->getPlayedCards()->where('location', STORMS) as $cId => $card) {
        if ($card->isDefender()) {
          $defenders[$pId][$card->getLocation()][] = $cId;
        }
        if ($card->isDefenderIgnoreBehind()) {
          $ignoreDefenders[$pId][$card->getLocation()][$cId] = 'behind';
        } elseif ($card->isIgnoreDefender()) {
          $ignoreDefenders[$pId][$card->getLocation()][$cId] = 'all';
        }
      }
    }

    if ($onlyDefenders) {
      return $defenders;
    }
    return [$defenders, $ignoreDefenders];
  }

  public static function getWinningPlayerByStorms()
  {
    $hero = null;
    $heroPos = -1;
    $companion = null;
    $companionPos = 999;
    // get player winning on each storms
    foreach (self::getAll() as $pId => $player) {
      $companionNew = explode('-', $player->getCompanionToken()->getLocation())[1];
      if ($companionNew < $companionPos) {
        $companion = $pId;
        $companionPos = $companionNew;
      } elseif ($companionNew == $companionPos) {
        $companion = -1;
      }

      $heroNew = explode('-', $player->getHeroToken()->getLocation())[1];
      if ($heroNew > $heroPos) {
        $hero = $pId;
        $heroPos = $heroNew;
      } elseif ($heroPos == $heroNew) {
        $hero = -1;
      }
    }
    return [STORM_LEFT => $hero, STORM_RIGHT => $companion];
  }

  public static function getIgnoreDefenders(&$defenders, $ignoreDefenders)
  {
    if (empty($ignoreDefenders)) {
      return;
    }

    $winners = self::getWinningPlayerByStorms();

    // if thereare ignoreDefenders, we ignore the ones not impacting
    foreach ($ignoreDefenders as $pId => $storms) {
      foreach ($storms as $storm => $cards) {
        foreach ($cards as $cId => $power) {
          if ($power == 'all') {
            unset($defenders[$pId][$storm]);
          } elseif ($power = 'behind' && !is_null($winners[$storm]) && $winners[$storm] != -1 && $winners[$storm] != $pId && isset($defenders[$pId][$storm])) {
            unset($defenders[$pId][$storm]);
          }
        }
      }
    }
  }

  public static function getIncreaseReserveCost()
  {
    $cost = 0;
    foreach (Cards::getPlayedCards(null) as $cId => $card) {
      $cost += $card->getIncreaseReserveCost();
    }
    return $cost;
  }

  public static function getReduceReserveCost()
  {
    $cost = 0;
    foreach (Cards::getPlayedCards(null) as $cId => $card) {
      $cost += $card->getReduceReserveCost();
    }
    return $cost;
  }

  public static function isExhaustedCharactersMorning()
  {
    foreach (Cards::getPlayedCards(null) as $cId => $card) {
      if ($card->isExhaustCharactersMorning() === true) {
        return true;
      }
    }
    return false;
  }

  public static function getBlockedExpeditions()
  {
    // Blocked by global (temporary)
    $blockedExpeditions = Globals::getBlockedExpeditions();
    // Blocked by "opposite defender" => always symetric
    $blockedOppositeDefenders = [];
    foreach (STORMS as $expedition) {
      $blockedOppositeDefenders[$expedition] = self::hasOppositeDefender($expedition);
    }
    // Blocked by defenders
    // $defenders = self::getDefenders();
    list($defenders, $ignoreDefenders) = self::getDefenders(false);
    self::getIgnoreDefenders($defenders, $ignoreDefenders);

    $statuses = [];
    foreach (Players::getAll() as $pId => $player) {
      foreach (STORMS as $expedition) {
        $blocked = false;
        // we cannot move as blocked by power (like Celebration Day)
        if (isset($blockedExpeditions[$pId]) && in_array($expedition, $blockedExpeditions[$pId])) {
          $blocked = true;
        }
        // Blocked by "opposite defender" cards
        if (!$blocked && $blockedOppositeDefenders[$expedition]) {
          $blocked = true;
        }
        if (!$blocked && !empty($defenders[$pId][$expedition] ?? [])) {
          $blocked = true;
        }

        $statuses[$pId][$expedition] = $blocked;
      }
    }

    return $statuses;
  }

  public static function getBiomesInStorm()
  {
    $allBiomes = [];
    foreach (self::getAll() as $pId => $player) {
      $playerStorm = $player->getBiomeInStorms();
      foreach ($playerStorm as $side => $biomes) {
        $expedition = $side == HERO ? STORM_LEFT : STORM_RIGHT;
        $newBiomes = [];
        foreach ($biomes as $biome) {
          $newBiomes[$biome] = $biome;
        }
        self::biomesModifier($newBiomes, $player, $expedition);
        $allBiomes[$pId][$expedition] = $newBiomes;
      }
    }
    return $allBiomes;
  }

  public static function filterBiomes($expeditionAttributes)
  {
    $allPlayerStorms = self::getBiomesInStorm();
    $authorizedLocations = [];
    foreach ($allPlayerStorms as $pId => $playerStorm) {
      $authorizedLocations[$pId] = [];
      // no constraints
      if (is_null($expeditionAttributes)) {
        $authorizedLocations[$pId] = array_keys($playerStorm);
        continue;
      }
      foreach ($expeditionAttributes as $attribute) {
        if (isset($playerStorm[STORM_LEFT][$attribute])) {
          $authorizedLocations[$pId][] = STORM_LEFT;
        }
        if (isset($playerStorm[STORM_RIGHT][$attribute])) {
          $authorizedLocations[$pId][] = STORM_RIGHT;
        }
      }
    }
    return $authorizedLocations;
  }

  public static function excludeBiomes($expeditionAttributes)
  {
    $allPlayerStorms = self::getBiomesInStorm();
    $excludedLocations = [];
    foreach ($allPlayerStorms as $pId => $playerStorm) {
      // no constraints
      foreach ($expeditionAttributes as $attribute) {
        if (!isset($playerStorm[STORM_LEFT][$attribute])) {
          $excludedLocations[$pId][] = STORM_LEFT;
        }
        if (!isset($playerStorm[STORM_RIGHT][$attribute])) {
          $excludedLocations[$pId][] = STORM_RIGHT;
        }
      }
    }
    return $excludedLocations;
  }

  public static function computeStorm($advance = false)
  {
    if (Globals::isTieBreakerMode()) {
      return [];
    }

    $players = self::getAll();
    $winners = [
      STORM_LEFT => [
        FOREST => ['pId' => null, 'value' => 0],
        MOUNTAIN => ['pId' => null, 'value' => 0],
        OCEAN => ['pId' => null, 'value' => 0],
      ],
      STORM_RIGHT => [
        FOREST => ['pId' => null, 'value' => 0],
        MOUNTAIN => ['pId' => null, 'value' => 0],
        OCEAN => ['pId' => null, 'value' => 0],
      ],
    ];

    // Winner calculation
    foreach ($players as $pId => $player) {
      $expeditions = $player->getBiomeStrength(STORMS, true);
      foreach ($expeditions as $expedition => $biomes) {
        foreach ($biomes as $biome => $value) {
          if ($winners[$expedition][$biome]['value'] < $value) {
            $winners[$expedition][$biome]['value'] = $value;
            $winners[$expedition][$biome]['pId'] = $pId;
          } elseif ($winners[$expedition][$biome]['value'] == $value) {
            $winners[$expedition][$biome]['pId'] = null;
          }
        }
      }
    }

    $movements = [];
    $blockedExpeditions = self::getBlockedExpeditions();
    // For each player, check whether hero and/or companion move forward
    foreach ([HERO, COMPANION] as $side) {
      foreach ($players as $pId => $player) {
        $n = 1;
        $biomesByStorm = $player->getBiomeInStorms();
        $biomes = $biomesByStorm[$side] ?? null;
        if (is_null($biomes)) {
          continue;
        }

        $move = false;
        $winningBiomes = [];
        $expedition = $side == HERO ? STORM_LEFT : STORM_RIGHT;
        $movements[$pId][$side] = [OCEAN => 0, FOREST => 0, MOUNTAIN => 0];
        if ($blockedExpeditions[$pId][$expedition]) {
          continue;
        }
        $newBiomes = [];
        foreach ($biomes as $biome) {
          $newBiomes[$biome] = $biome;
        }
        self::biomesModifier($newBiomes, $player, $expedition);

        foreach ($newBiomes as $i => $biome) {
          $win = $winners[$expedition][$biome]['pId'] == $pId;
          $movements[$pId][$side][$biome] = $win ? 2 : 1;

          if ($win) {
            $move = true;
            $winningBiomes[] = $biome;
          }
        }

        if ($advance && $move) {
          if ($player->hasAdvanceTwiceDusk($expedition)) {
            $n = 2;
          }
          $player->advanceStorm($side, $winningBiomes, $n);
        }
      }
    }
    return $movements;
  }

  public static function biomesModifier(&$biomes, $player, $expedition, $tiebreak = false)
  {
    foreach (Cards::getPlayedCards(null) as $cId => $card) {
      $updateExpeditions = $card->getUpdateExpeditions();
      if (!empty($updateExpeditions)) {

        if (($updateExpeditions['type'] ?? '') == 'all') {
          self::updateBiomesModifier($biomes, $updateExpeditions, $tiebreak);
        }

        if (($updateExpeditions['type'] ?? '') == ME && $card->getPId() == $player->getId()) {
          self::updateBiomesModifier($biomes, $updateExpeditions, $tiebreak);
        }

        if (($updateExpeditions['type'] ?? '') == OPPONENT && $card->getPId() != $player->getId()) {
          self::updateBiomesModifier($biomes, $updateExpeditions, $tiebreak);
        }

        if (($updateExpeditions['type'] ?? '') == 'source' && $card->getPId() == $player->getId() && $card->getLocation() == $expedition) {
          self::updateBiomesModifier($biomes, $updateExpeditions, $tiebreak);
        }

        if (($updateExpeditions['type'] ?? '') == 'sourceAll' && $card->getLocation() == $expedition) {
          self::updateBiomesModifier($biomes, $updateExpeditions, $tiebreak);
        }
      }

      // TODO: manage multiplayer
      if ($card->getLocation() == $expedition && $player->getId() != $card->getPId()) {
        if ($card->isOpponentOceanOnly()) {
          $biomes = [OCEAN => OCEAN];
        } elseif ($card->isOpponentForestOnly()) {
          $biomes = [FOREST => FOREST];
        }
      }
    }
  }

  public static function updateBiomesModifier(&$biomes, $updateExpeditions, $tiebreak)
  {
    // remove all the one to remove
    foreach ($updateExpeditions['regionsRemove'] ?? [] as $region) {
      // foreach (array_keys($biomes, $region) as $key) {
      if (isset($biomes[$region])) {
        unset($biomes[$region]);
      }
    }

    // add
    foreach ($updateExpeditions['regionsAdd'] ?? [] as $region) {
      if (!$tiebreak && !in_array($region, $biomes)) {
        $biomes[$region] = $region;
      } elseif ($tiebreak && !isset($biomes[$region])) {
        $biomes[$region] = 0;
      }
    }
  }

  public static function setStats()
  {
    $matchup = [];
    $statData = [];
    foreach (self::getAll() as $pId => $player) {
      $matchup[] = $player->getHero()->getStatData();
      $cardStat = [];
      $count = 1;
      foreach (Cards::getFiltered($pId)->where('location', "deck-$pId") as $cId => $card) {
        if ($card->getRarity() == RARITY_UNIQUE) {
          continue;
        }
        // encoding UID into Ints
        // 103423
        // 1 = in deck
        // 0034 = card number
        // 2 = Rarity R1
        // 3 = faction code
        $uid = explode('_', $card->getUid());
        $rarityUid = $uid[5] == 'C' ? 1 : ($uid[5] == 'R' ? 2 : 3);
        $factionUid = array_search(($uid[3] == 'OR' ? 'OD' : $uid[3]), FACTIONS) + 1;
        $s = 'setCard' . $count;
        $cardStat[$cId] = 'card' . $count;

        Stats::$s($player, 100000 + intval($uid[4]) * 100 + $rarityUid * 10 + $factionUid);
        $count++;
        if ($count > 40) {
          break;
        }
      }
      $statData[$pId] = $cardStat;
    }
    sort($matchup);
    Stats::setMatchUp($matchup[0] * 100 + $matchup[1]);
    Globals::setStatMapping($statData);
  }
}
