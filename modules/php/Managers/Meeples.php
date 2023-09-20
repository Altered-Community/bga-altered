<?php
namespace ALT\Managers;
use ALT\Core\Stats;
use ALT\Core\Globals;
use ALT\Helpers\UserException;
use ALT\Helpers\Collection;

/* Class to manage all the meeples for altered */

class Meeples extends \ALT\Helpers\CachedPieces
{
  protected static $table = 'meeples';
  protected static $prefix = 'meeple_';
  protected static $customFields = ['type', 'player_id'];
  protected static $datas = null;

  protected static function cast($meeple)
  {
    return [
      'id' => (int) $meeple['id'],
      'location' => $meeple['location'],
      'pId' => $meeple['player_id'],
      'type' => $meeple['type'],
      'state' => $meeple['state'],
    ];
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
    $meeples[] = ['type' => COMPANION, 'location' => 'storm-0', 'player_id' => $player->getId()];
    $meeples[] = ['type' => ALTERATEUR, 'location' => 'storm-7', 'player_id' => $player->getId()];
    return self::create($meeples);
  }

  public static function countMeeples($location, $type)
  {
    return self::getOfType($location, $type)->count();
  }

  public static function getOfType($location, $type)
  {
    return self::getFilteredQuery(null, $location, $type)->get();
  }

  /**
   * Generic base query
   */
  public function getFilteredQuery($pId = null, $location, $type)
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
    return $query;
  }
}
