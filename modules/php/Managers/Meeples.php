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

  /* Creation of various meeples */
  public static function setupNewGame($players, $options)
  {
    // $meeples = [];

    // return self::getMany(self::create($meeples));
  }
}
