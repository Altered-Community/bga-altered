<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * Altered implementation : © <Your name here> <Your email address here>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * altered.game.php
 *
 * This is the main file for your game logic.
 *
 * In this PHP file, you are going to defines the rules of the game.
 *
 */

$swdNamespaceAutoload = function ($class) {
  $classParts = explode('\\', $class);
  if ($classParts[0] == 'ALT') {
    array_shift($classParts);
    $file = dirname(__FILE__) . '/modules/php/' . implode(DIRECTORY_SEPARATOR, $classParts) . '.php';
    if (file_exists($file)) {
      require_once $file;
    } else {
      var_dump('Cannot find file : ' . $file);
    }
  }
};
spl_autoload_register($swdNamespaceAutoload, true, true);

require_once APP_GAMEMODULE_PATH . 'module/table/table.game.php';

use ALT\Managers\Meeples;
use ALT\Managers\Cards;
use ALT\Managers\Players;
use ALT\Managers\Scores;
use ALT\Core\Globals;
use ALT\Helpers\Log;
use ALT\Core\Preferences;
use ALT\Core\Stats;
use ALT\Core\Engine;

class Altered extends Table
{
  public static $instance = null;

  function __construct()
  {
    parent::__construct();
    self::$instance = $this;
    self::initGameStateLabels([
      'logging' => 10,
    ]);
    Engine::boot();
    //   Stats::checkExistence();
  }

  public static function get()
  {
    return self::$instance;
  }

  protected function getGameName()
  {
    return 'altered';
  }

  /*
        setupNewGame:
        
        This method is called only once, when a new game is launched.
        In this method, you must setup the game according to the game rules, so that
        the game is ready to be played.
    */
  protected function setupNewGame($players, $options = [])
  {
    // Set the colors of the players with HTML color code
    // The default below is red/green/blue/orange/brown
    // The number of colors defined here must correspond to the maximum number of players allowed for the gams
    $gameinfos = self::getGameinfos();
    $default_colors = $gameinfos['player_colors'];

    // Create players
    // Note: if you added some extra field on "player" table in the database (dbmodel.sql), you can initialize it there.
    $sql = 'INSERT INTO player (player_id, player_color, player_canal, player_name, player_avatar) VALUES ';
    $values = [];
    foreach ($players as $player_id => $player) {
      $color = array_shift($default_colors);
      $values[] =
        "('" .
        $player_id .
        "','$color','" .
        $player['player_canal'] .
        "','" .
        addslashes($player['player_name']) .
        "','" .
        addslashes($player['player_avatar']) .
        "')";
    }
    $sql .= implode(',', $values);
    self::DbQuery($sql);
    self::reattributeColorsBasedOnPreferences($players, $gameinfos['player_colors']);
    self::reloadPlayersBasicInfos();

    /************ Start the game initialization *****/

    // Init global values with their initial values
    //self::setGameStateInitialValue( 'my_first_global_variable', 0 );

    // Init game statistics
    // (note: statistics used in this file must be defined in your stats.inc.php file)
    //self::initStat( 'table', 'table_teststat1', 0 );    // Init a table statistics
    //self::initStat( 'player', 'player_teststat1', 0 );  // Init a player statistics (for all players)

    // TODO: setup the initial game situation here

    // Activate first player (which is in general a good idea :) )
    $this->activeNextPlayer();

    /************ End of the game initialization *****/
  }

  public function getAllDatas()
  {
    $pId = self::getCurrentPId();
    return [
        // 'prefs' => Preferences::getUiData($pId),
        // 'players' => Players::getUiData($pId),
        // 'cards' => ZooCards::getUiData(),
        // 'buildings' => Buildings::getUiData(),
        // 'meeples' => Meeples::getUiData(),
      ];
  }

  function getGameProgression()
  {
    // TODO: compute and return the game progression

    return 50;
  }

  function actChangePreference($pref, $value)
  {
    Preferences::set($this->getCurrentPId(), $pref, $value);
  }

  ///////////////////////////////////////////////
  ///////////////////////////////////////////////
  ////////////   Custom Turn Order   ////////////
  ///////////////////////////////////////////////
  ///////////////////////////////////////////////
  public function initCustomTurnOrder(
    $key,
    $order,
    $callback,
    $endCallback,
    $loop = false,
    $autoNext = true,
    $args = []
  ) {
    $turnOrders = Globals::getCustomTurnOrders();
    $turnOrders[$key] = [
      'order' => $order ?? Players::getTurnOrder(),
      'index' => -1,
      'callback' => $callback,
      'args' => $args, // Useful mostly for auto card listeners
      'endCallback' => $endCallback,
      'loop' => $loop,
    ];
    Globals::setCustomTurnOrders($turnOrders);

    if ($autoNext) {
      $this->nextPlayerCustomOrder($key);
    }
  }

  public function initCustomDefaultTurnOrder($key, $callback, $endCallback, $loop = false, $autoNext = true)
  {
    $this->initCustomTurnOrder($key, null, $callback, $endCallback, $loop, $autoNext);
  }

  public function nextPlayerCustomOrder($key)
  {
    $turnOrders = Globals::getCustomTurnOrders();
    if (!isset($turnOrders[$key])) {
      throw new BgaVisibleSystemException(
        'Asking for the next player of a custom turn order not initialized : ' . $key
      );
    }

    // Increase index and save
    $o = $turnOrders[$key];
    $i = $o['index'] + 1;
    if ($i == count($o['order']) && $o['loop']) {
      $i = 0;
    }
    $turnOrders[$key]['index'] = $i;
    Globals::setCustomTurnOrders($turnOrders);

    if ($i < count($o['order'])) {
      $this->gamestate->jumpToState(ST_GENERIC_NEXT_PLAYER);
      $this->gamestate->changeActivePlayer($o['order'][$i]);
      $this->jumpToOrCall($o['callback'], $o['args']);
    } else {
      $this->endCustomOrder($key);
    }
  }

  public function endCustomOrder($key)
  {
    $turnOrders = Globals::getCustomTurnOrders();
    if (!isset($turnOrders[$key])) {
      throw new BgaVisibleSystemException('Asking for ending a custom turn order not initialized : ' . $key);
    }

    $o = $turnOrders[$key];
    $turnOrders[$key]['index'] = count($o['order']);
    Globals::setCustomTurnOrders($turnOrders);
    $callback = $o['endCallback'];
    $this->jumpToOrCall($callback);
  }

  public function jumpToOrCall($mixed, $args = [])
  {
    if (is_int($mixed) && array_key_exists($mixed, $this->gamestate->states)) {
      $this->gamestate->jumpToState($mixed);
    } elseif (method_exists($this, $mixed)) {
      $method = $mixed;
      $this->$method($args);
    } else {
      throw new BgaVisibleSystemException('Failing to jumpToOrCall  : ' . $mixed);
    }
  }

  //////////////////////////////////////////////////////////////////////////////
  //////////// Zombie
  ////////////

  /*
        zombieTurn:
        
        This method is called each time it is the turn of a player who has quit the game (= "zombie" player).
        You can do whatever you want in order to make sure the turn of this player ends appropriately
        (ex: pass).
        
        Important: your zombie code will be called when the player leaves the game. This action is triggered
        from the main site and propagated to the gameserver from a server, not from a browser.
        As a consequence, there is no current player associated to this action. In your zombieTurn function,
        you must _never_ use getCurrentPlayerId() or getCurrentPlayerName(), otherwise it will fail with a "Not logged" error message. 
    */

  function zombieTurn($state, $active_player)
  {
    $statename = $state['name'];

    if ($state['type'] === 'activeplayer') {
      switch ($statename) {
        default:
          $this->gamestate->nextState('zombiePass');
          break;
      }

      return;
    }

    if ($state['type'] === 'multipleactiveplayer') {
      // Make sure player is in a non blocking status for role turn
      $this->gamestate->setPlayerNonMultiactive($active_player, '');

      return;
    }

    throw new feException('Zombie mode not supported at this game state: ' . $statename);
  }

  ///////////////////////////////////////////////////////////////////////////////////:
  ////////// DB upgrade
  //////////

  /*
        upgradeTableDb:
        
        You don't have to care about this until your game has been published on BGA.
        Once your game is on BGA, this method is called everytime the system detects a game running with your old
        Database scheme.
        In this case, if you change your Database scheme, you just have to apply the needed changes in order to
        update the game database and allow the game to continue to run with your new version.
    
    */

  function upgradeTableDb($from_version)
  {
    //test
  }

  /////////////////////////////////////////////////////////////
  // Exposing protected methods, please use at your own risk //
  /////////////////////////////////////////////////////////////

  // Exposing protected method getCurrentPlayerId
  public static function getCurrentPId()
  {
    return self::getCurrentPlayerId();
  }

  // Exposing protected method translation
  public static function translate($text)
  {
    return self::_($text);
  }
}
