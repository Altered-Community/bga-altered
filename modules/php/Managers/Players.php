<?php
namespace ALT\Managers;
use ALT\Core\Game;
use ALT\Core\Globals;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Core\Notifications;

/*
 * Players manager : allows to easily access players ...
 *  a player is an instance of Player class
 */
class Players extends \ARK\Helpers\DB_Manager
{
  protected static $table = 'player';
  protected static $primary = 'player_id';
  protected static function cast($row)
  {
    return new \ARK\Models\Player($row);
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

  public function getAll()
  {
    return self::DB()->get(false);
  }

  /*
   * get : returns the Player object for the given player ID
   */
  public function get($pId = null)
  {
    $pId = $pId ?: self::getActiveId();
    return self::DB()
      ->where($pId)
      ->getSingle();
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
    return self::DB()->count();
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

  public function checkEndOfGamePlayer($player)
  {
    if (Globals::getEndRemainingPlayers() != []) {
      return true;
    }
    if (Globals::isSolo()) {
      return false;
    }

    $score = $player->updateScore();
    if ($score >= 100) {
      Notifications::endOfGame();
      Globals::setEndRemainingPlayers(self::getAll()->getIds());
      Globals::setEndTriggered(true);
      Stats::incEndGameTriggered($player);
      return true;
    }

    return false;
  }

  public function checkEndOfGame()
  {
    if (Globals::getEndRemainingPlayers() != []) {
      return true;
    }
    if (Globals::isSolo()) {
      return false;
    }

    foreach (self::getAll() as $pId => $player) {
      if (self::checkEndOfGamePlayer($player)) {
        return true;
      }
    }

    return false;
  }
}
