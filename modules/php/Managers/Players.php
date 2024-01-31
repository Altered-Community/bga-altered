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

  public function setupNewGame($players, $options)
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
      // 'money',
      // 'reputation',
      // 'appeal',
      // 'conservation',
      // 'xtoken',
      // 'map_id',
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
        // 25,
        // 1,
        // $appeal++,
        // 0,
        // 0,
        // $map,
      ];
    }
    $query->values($values);
    Game::get()->reattributeColorsBasedOnPreferences($players, $gameInfos['player_colors']);
    Game::get()->reloadPlayersBasicInfos();
  }

  public function getActiveId()
  {
    return (int) Game::get()->getActivePlayerId();
  }

  public function getCurrentId()
  {
    return (int) Game::get()->getCurrentPId();
  }

  /*
   * get : returns the Player object for the given player ID
   */
  public function get($id = null)
  {
    return parent::get($id ?? self::getActiveId());
  }

  public function getActive()
  {
    return self::get();
  }

  public function getCurrent()
  {
    return self::get(self::getCurrentId());
  }

  public function getNextId($player)
  {
    $pId = is_int($player) ? $player : $player->getId();
    $table = Game::get()->getNextPlayerTable();
    return $table[$pId];
  }

  public function getNext($player)
  {
    return self::get(self::getNextId($player));
  }

  public function getPrevious($player)
  {
    $table = Game::get()->getPrevPlayerTable();
    $pId = (int) $table[$player->getId()];
    return self::get($pId);
  }

  /*
   * Return the number of players
   */
  public function count()
  {
    return self::getAll()->count();
  }

  /*
   * getUiData : get all ui data of all players
   */
  public function getUiData($pId)
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
  public function getTurnOrder($firstPlayer = null)
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

  public function checkVictory()
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
      Game::get()->jumpToOrCall(ST_PRE_END_OF_GAME);
      return true;
    }

    return false;
  }

  public function initializeDecks()
  {
    foreach (self::getAll() as $pId => $player) {
      $player->initializeDecks();
    }
  }

  public function computeStorm($advance = false)
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
    // For each player, check whether hero and/or companion move forward
    foreach ([HERO, COMPANION] as $side) {
      foreach ($players as $pId => $player) {
        $biomesByStorm = $player->getBiomeInStorms();
        $biomes = $biomesByStorm[$side] ?? null;
        if (is_null($biomes)) continue;

        $move = false;
        $winningBiomes = [];
        $expedition = $side == HERO ? STORM_LEFT : STORM_RIGHT;
        $movements[$pId][$side] = [OCEAN => 0, FOREST => 0, MOUNTAIN => 0];
        if ($player->hasDefender($expedition)) {
          continue;
        }

        foreach ($biomes as $i => $biome) {
          $win = $winners[$expedition][$biome]['pId'] == $pId;
          $movements[$pId][$side][$biome] = $win ? 2 : 1;

          if ($win) {
            $move = true;
            $winningBiomes[] = $biome;
          }
        }

        if ($advance && $move) {
          $player->advanceStorm($side, $winningBiomes);
        }
      }
    }
    return $movements;
  }
}
