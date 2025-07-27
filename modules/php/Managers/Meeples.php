<?php

namespace ALT\Managers;

use ALT\Core\Stats;
use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Helpers\UserException;
use ALT\Helpers\Collection;
use ALT\Models\Meeple;

/* Class to manage all the meeples for altered */

class Meeples extends \ALT\Helpers\CachedPieces
{
  protected static $table = 'meeples';
  protected static $prefix = 'meeple_';
  protected static $customFields = ['type', 'player_id'];
  protected static $datas = null;
  protected static $autoremovePrefix = false;

  protected static function cast($meeple)
  {
    return new Meeple($meeple);
    // return [
    //   'id' => (int) $meeple['id'],
    //   'location' => $meeple['location'],
    //   'pId' => $meeple['player_id'],
    //   'type' => $meeple['type'],
    //   'state' => $meeple['state'],
    // ];
  }
  public static function getUiData()
  {
    return self::getAll()->toArray();
  }

  ////////////////////////////////////
  //  ____       _
  // / ___|  ___| |_ _   _ _ __
  // \___ \ / _ \ __| | | | '_ \
  //  ___) |  __/ |_| |_| | |_) |
  // |____/ \___|\__|\__,_| .__/
  //                      |_|
  ////////////////////////////////////

  public static function setupPlayer($player)
  {
    $meeples = [];
    $meeples[] = ['type' => COMPANION, 'location' => 'storm-7', 'player_id' => $player->getId()];
    $meeples[] = ['type' => HERO, 'location' => 'storm-0', 'player_id' => $player->getId()];
    return self::create($meeples);
  }

  public static function createHeroMarkers()
  {
    $toCreate = [];
    foreach (Players::getAll() as $pId => $player) {
      $hero = $player->getHero();
      if ($hero->isCreateMarkers()) {
        $toCreate[] = ['type' => OCEAN, 'location' => 'card-' . $hero->getId(), 'player_id' => $player->getId()];
        $toCreate[] = ['type' => FOREST, 'location' => 'card-' . $hero->getId(), 'player_id' => $player->getId()];
        $toCreate[] = ['type' => MOUNTAIN, 'location' => 'card-' . $hero->getId(), 'player_id' => $player->getId()];
      }
    }
    return self::create($toCreate);
  }

  public static function countMeeples($location, $type)
  {
    return self::getOfType($location, $type)->count();
  }

  public static function getOfType($location, $type)
  {
    return self::getFilteredQuery(null, $location, $type)->get();
  }

  public static function getStormTokens($pId)
  {
    return self::getFilteredQuery($pId, null, [COMPANION, HERO])->get();
  }

  public static function getAscended($pId, $location)
  {
    return self::getFilteredQuery($pId, $location, [ASCEND])->get();
  }

  /**
   * Generic base query
   */
  public static function getFilteredQuery($pId = null, $location, $type)
  {
    $query = self::getSelectQuery();

    if ($pId != null) {
      $query = $query->wherePlayer($pId);
    }
    if ($location != null) {
      $query = $query->where('meeple_location', $location);
    }
    if ($type != null) {
      if (is_array($type)) {
        $query = $query->whereIn('type', $type);
      } else {
        $query = $query->where('type', strpos($type, '%') === false ? '=' : 'LIKE', $type);
      }
    }
    $query = $query->orderBy('meeple_state', 'ASC');
    return $query;
  }

  public static function createOnCard($type, $cardId, $pId, $nbr = 1)
  {
    if ($nbr == 1) {
      return [self::singleCreate(['type' => $type, 'location' => 'card-' . $cardId, 'player_id' => $pId])];
    } else {
      return self::create([['type' => $type, 'location' => 'card-' . $cardId, 'player_id' => $pId, 'nbr' => $nbr]]);
    }
  }

  public static function nightCleanup()
  {
    $ascended =  self::getFilteredQuery(null, null, [ASCEND])->get();
    $toDelete = $ascended->getIds();
    if (count($ascended) >= 1) {
      self::delete($ascended->getIds());
      Notifications::silentKill($toDelete);
    }
  }
}
