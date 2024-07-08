<?php

namespace ALT\Core;

use ALT\Core\Game;

require_once dirname(__FILE__) . '/../gameoptions.inc.php';

/*
 * User preferences
 */

class Preferences extends \ALT\Helpers\DB_Manager
{
  protected static $table = 'user_preferences';
  protected static $primary = 'id';
  protected static $log = false; // Turn off log to avoid undoing changes in this table
  protected static function cast($row)
  {
    return $row;
  }

  protected static $game_preferences = [];

  public static function getLocalPrefsData()
  {
    return [
      \ALT\OPTION_CONFIRM => [
        'name' => totranslate('Turn confirmation'),
        'needReload' => false,
        'default' => \ALT\OPTION_CONFIRM_DISABLED,
        'values' => [
          \ALT\OPTION_CONFIRM_ENABLED => ['name' => totranslate('Enabled')],
          \ALT\OPTION_CONFIRM_DISABLED => ['name' => totranslate('Disabled')],
          \ALT\OPTION_CONFIRM_TIMER => ['name' => totranslate('Enabled with timer')],
        ],
      ],
      \ALT\OPTION_CONFIRM_UNDOABLE => [
        'name' => totranslate('Undoable actions confirmation'),
        'needReload' => false,
        'values' => [
          \ALT\OPTION_CONFIRM_ENABLED => ['name' => totranslate('Enabled')],
          \ALT\OPTION_CONFIRM_DISABLED => ['name' => totranslate('Disabled')],
        ],
      ],
    ];
  }

  /*
   * Setup new game
   */
  public static function setupNewGame($players, $prefs)
  {
    // Load user preferences
    // include dirname(__FILE__) . '/../../../gameoptions.inc.php';
    $game_preferences = self::getLocalPrefsData();

    $values = [];
    foreach ($game_preferences as $id => $data) {
      $defaultValue = $data['default'] ?? array_keys($data['values'])[0];

      foreach ($players as $pId => $infos) {
        $values[] = [
          'player_id' => $pId,
          'pref_id' => $id,
          'pref_value' => $prefs[$pId][$id] ?? $defaultValue,
        ];
      }
    }

    self::DB()
      ->multipleInsert(['player_id', 'pref_id', 'pref_value'])
      ->values($values);
  }

  /*
   * Check if stored user preferences match declared preferences, and create otherwise
   */
  public static function checkExistence()
  {
    // Load user preferences
    // include dirname(__FILE__) . '/../../../gameoptions.inc.php';
    $game_preferences = self::getLocalPrefsData();

    $playerIds = array_keys(Game::get()->loadPlayersBasicInfos());
    $values = [];
    foreach ($game_preferences as $id => $data) {
      $defaultValue = $data['default'] ?? array_keys($data['values'])[0];

      foreach ($playerIds as $pId) {
        if (self::get($pId, $id) == null) {
          $values[] = [
            'player_id' => $pId,
            'pref_id' => $id,
            'pref_value' => $defaultValue,
          ];
        }
      }
    }

    if (!empty($values)) {
      self::DB()
        ->multipleInsert(['player_id', 'pref_id', 'pref_value'])
        ->values($values);
    }
  }

  /**
   * Get UI data (useful to check inconsistency)
   */
  public static function getUiData($pId)
  {
    self::checkExistence();
    return self::DB()
      ->where('player_id', $pId)
      ->get()
      ->toArray();
  }

  /*
   * Get a user preference
   */
  public static function get($pId, $prefId)
  {
    return self::DB()
      ->select(['pref_value'])
      ->where('player_id', $pId)
      ->where('pref_id', $prefId)
      ->get(true)['pref_value'] ?? null;
  }

  /*
   * Set a user preference
   */
  public static function set($pId, $prefId, $value)
  {
    return self::DB()
      ->update(['pref_value' => $value])
      ->where('player_id', $pId)
      ->where('pref_id', $prefId)
      ->run();
  }
}
