<?php

namespace ALT\Core;

use ALT\Core\Game;
use ALT\Helpers\Utils;

/*
 * Globals
 */

class Globals extends \ALT\Helpers\DB_Manager
{
  protected static $initialized = false;
  protected static $variables = [
    'engine' => 'obj', // DO NOT MODIFY, USED IN ENGINE MODULE
    'engineChoices' => 'int', // DO NOT MODIFY, USED IN ENGINE MODULE
    'callbackEngineResolved' => 'obj', // DO NOT MODIFY, USED IN ENGINE MODULE
    'anytimeRecursion' => 'int', // DO NOT MODIFY, USED IN ENGINE MODULE
    'customTurnOrders' => 'obj', // DO NOT MODIFY, USED FOR CUSTOM TURN ORDER FEATURE

    'playerDecks' => 'obj',
    'deckOptions' => 'str',

    'firstPlayer' => 'int',
    'skippedPlayers' => 'obj',
    'dayPhase' => 'bool',
    'activePId' => 'int',

    'storm' => 'obj',
    'day' => 'int',
    'phase' => 'int',
    'heroes' => 'obj',
    'playedCards' => 'int',
    'stormMoves' => 'obj',
    'blockedExpeditions' => 'obj', // pId => StormLet/Right
    'tieBreakerMode' => 'bool',
    'instantWin' => 'bool',

    'diceRolls' => 'obj',

    'firstDayManaSelection' => 'obj',
    'nightSelection' => 'obj',
    'deckSelection' => 'obj',
    'costReduction' => 'obj', // pId => character => cost
    'nextCharacterBoost' => 'int',
    'nextCharacterCost3Anchored' => 'bool',
    'additionalEffect' => 'obj', // use to trigger R/H of next character
    'afterRest' => 'obj', // used for triggers readd during dusk but that should be trigerred after Rest

    'newDayManaSelection' => 'obj', // to avoid warning for legacy games
  ];

  protected static $table = 'global_variables';
  protected static $primary = 'name';
  protected static function cast($row)
  {
    $val = json_decode(\stripslashes($row['value']), true);
    return self::$variables[$row['name']] == 'int' ? ((int) $val) : $val;
  }

  /*
   * Fetch all existings variables from DB
   */
  protected static $data = [];
  public static function fetch()
  {
    // Turn of LOG to avoid infinite loop (Globals::isLogging() calling itself for fetching)
    $tmp = self::$log;
    self::$log = false;

    foreach (self::DB()
      ->select(['value', 'name'])
      ->get(false)
      as $name => $variable) {
      if (\array_key_exists($name, self::$variables)) {
        self::$data[$name] = $variable;
      }
    }
    self::$initialized = true;
    self::$log = $tmp;
  }

  /*
   * Create and store a global variable declared in this file but not present in DB yet
   *  (only happens when adding globals while a game is running)
   */
  public static function create($name)
  {
    if (!\array_key_exists($name, self::$variables)) {
      return;
    }

    $default = [
      'int' => 0,
      'obj' => [],
      'bool' => false,
      'str' => '',
    ];
    $val = $default[self::$variables[$name]];
    self::DB()->insert(
      [
        'name' => $name,
        'value' => \json_encode($val),
      ],
      true
    );
    self::$data[$name] = $val;
  }

  public static function isBreak()
  {
    return !is_null(self::getBreakPlayer()) && self::getBreakPlayer() != -1;
  }

  /*
   * Magic method that intercept not defined static method and do the appropriate stuff
   */
  public static function __callStatic($method, $args)
  {
    if (!self::$initialized) {
      self::fetch();
    }

    if (preg_match('/^([gs]et|inc|is)([A-Z])(.*)$/', $method, $match)) {
      // Sanity check : does the name correspond to a declared variable ?
      $name = mb_strtolower($match[2]) . $match[3];
      if (!\array_key_exists($name, self::$variables)) {
        throw new \InvalidArgumentException("Property {$name} doesn't exist");
      }

      // Create in DB if don't exist yet
      if (!\array_key_exists($name, self::$data)) {
        self::create($name);
      }

      if ($match[1] == 'get') {
        // Basic getters
        return self::$data[$name];
      } elseif ($match[1] == 'is') {
        // Boolean getter
        if (self::$variables[$name] != 'bool') {
          throw new \InvalidArgumentException("Property {$name} is not of type bool");
        }
        return (bool) self::$data[$name];
      } elseif ($match[1] == 'set') {
        // Setters in DB and update cache
        $value = $args[0];
        if (self::$variables[$name] == 'int') {
          $value = (int) $value;
        }
        if (self::$variables[$name] == 'bool') {
          $value = (bool) $value;
        }

        self::$data[$name] = $value;
        self::DB()->update(['value' => \addslashes(\json_encode($value))], $name);
        return $value;
      } elseif ($match[1] == 'inc') {
        if (self::$variables[$name] != 'int') {
          throw new \InvalidArgumentException("Trying to increase {$name} which is not an int");
        }

        $getter = 'get' . $match[2] . $match[3];
        $setter = 'set' . $match[2] . $match[3];
        return self::$setter(self::$getter() + (empty($args) ? 1 : $args[0]));
      }
    }
    throw new \feException(print_r(debug_print_backtrace()));
    return undefined;
  }

  /*
   * Setup new game
   */
  public static function setupNewGame($players, $options)
  {
    // Storm
    $storm = [];
    $storm[] = ['cardId' => 0, 'visible' => true, 'rotated' => false];
    $stormKeys = [1, 2, 3];
    shuffle($stormKeys);
    for ($i = 0; $i < 3; $i++) {
      $key = array_shift($stormKeys);
      $storm[] = ['cardId' => $key, 'visible' => false, 'rotated' => bga_rand(0, 1) == 1];
    }
    $storm[] = ['cardId' => 4, 'visible' => true, 'rotated' => false];
    self::setStorm($storm);

    self::setDay(0);
    self::setPlayedCards(0);
    self::setDayPhase(false);
    // self::setDeckOptions($options[OPTION_DECKS] ?? 0);
    self::setDeckOptions(OPTION_DECKS_STARTER);
  }

  public static function getStorm($ui = false)
  {
    $storm = self::$data['storm'];

    // Hide hidden datas for UI
    if ($ui) {
      foreach ($storm as $i => &$stormCard) {
        if (!$stormCard['visible']) {
          $stormCard['cardId'] = STORM_BACK;
          unset($stormCard['rotated']);
        }
        unset($stormCard['visible']);
      }
    }

    return $storm;
  }
}
