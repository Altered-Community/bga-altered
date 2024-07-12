<?php

namespace ALT;

use ALT\Core\Globals;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Engine;
use ALT\Core\Game;
use ALT\Core\Notifications;
use ALT\Helpers\Utils;
use ALT\Helpers\FT;
use ALT\Core\Stats;
use ALT\Helpers\Collection;
use ALT\Helpers\FlowConvertor;
use ALT\Managers\Meeples;

trait DebugTrait
{
  function actDisplayAllCards()
  {
    $datas = [];

    require_once dirname(__FILE__) . '/Cards/cards.inc.php';
    // foreach (DEMO as $faction => $deck) {
    //   foreach ($deck as $cardId => $n) {
    //     $className = '\\ALT\\Cards\\' . $faction . '\\' . $cardId;
    //     $class = new $className(null);
    //     $datas[] = $class->jsonSerialize();
    //   }
    // }

    foreach (MAP_REFS_CLASSES as $cardId => $className) {
      $className = '\\ALT\\Cards\\' . str_replace('/', '\\', $className);
      $class = new $className(null);
      $datas[] = $class->jsonSerialize();
    }

    // require_once dirname(__FILE__) . '/../../misc/list.inc.php';
    // foreach (ALL_CARDS as $filename) {
    //   if (!file_exists(dirname(__FILE__) . '/../../misc/CoreSetV3/' . $filename . '.php')) {
    //     continue;
    //   }
    //   require_once dirname(__FILE__) . '/../../misc/CoreSetV3/' . $filename . '.php';
    //   $t = explode('/', $filename);
    //   $className = '\\ALT\\Cards\\' . $t[0] . '\\' . $t[1];
    //   $class = new $className(null);

    //   if ($class->getRarity() == RARITY_COMMON) {
    //     $datas[] = $class;
    //   }
    // }

    return $datas;
  }

  function decks()
  {
    // $json = toto(dirname(__FILE__) . '/../../misc/prod_assets.json');
    // $data = json_decode($json, true);
    // // throw new \feException(print_r($data));
    // $cardList = '';
    // foreach ($data['hydra:member'] as $card) {
    //   $cardList .= "'" . $card['reference'] . "',";
    // }

    // throw new \feException($cardList);
    // foreach (ALL_CARDS as $filename) {
    //   if (!file_exists(dirname(__FILE__) . '/../../misc/CoreSetV3/' . $filename . '.php')) {
    //     continue;
    //   }
    //   require_once dirname(__FILE__) . '/../../misc/CoreSetV3/' . $filename . '.php';
    //   $t = explode('/', $filename);
    //   $className = '\\ALT\\Cards\\' . $t[0] . '\\' . $t[1];
    //   $class = new $className(null);

    //   if ($class->getRarity() == RARITY_COMMON) {
    //     $datas[] = $class;
    //   }
    // }
  }

  function tp()
  {
    Players::initializeDecks();
  }

  function dv()
  {
    Globals::setEndTriggered(true);
  }

  function vt()
  {
    // Globals::setupNewGame([], []);
    // Cards::setupNewGame(Players::getAll()->getIds(), []);
    // $this->actFirstDayMana([17, 21, 22]);
    // $this->actDayMana([20]);

    // Cards::get(3)->boost(1, 'test', true);
    // throw new \feException(print_r(Players::getCurrent()->getBiomeInStorms()));
    // $this->actTakeAtomicAction('actHand', [3, STORM_LEFT]);
    // $this->actTakeAtomicAction('actReserve', [29, STORM_LEFT]);
    // $this->actTakeAtomicAction('actSupport', [226]);
    // $this->actTakeAtomicAction('actTap', [236]);
    // $this->actTakeAtomicAction('actPass', []);
    // $this->actTakeAtomicAction('actDiscard', [[9]]);
    // $this->actTakeAtomicAction('actTarget', [[17]]);
    $this->actTakeAtomicAction('actDiscardAdd', [577]);

    // throw new \feException(Cards::get(11)->countToken(FLEETING));
    // Stats::incDays(2);
    // Stats::setWinner(Players::getActive(), true);
    // throw new \feException(print_r(Globals::getDeckContent())); //->isDefender());
  }

  function tv()
  {
    // Cards::get(24)->setTapped(true);
    // Cards::get(3)->setEffectHand([[TARGET_ALL_CHARACTER_2 => [[BOOST => 2], [BOOST => 2]]]]);
    // Cards::get(32)->setEffectPassive([
    //   'ChooseAssignment' => [
    //     'condition' => 'firstCharacterPlayed',
    //     'output' => FT::SEQ(FT::GAIN(EFFECT, BOOST), ['action' => SPECIAL_EFFECT, 'args' => ['effect' => 'useCard']]),
    //   ],
    // ]);
    // Cards::get(1)->isListeningTo([]);
    // throw new \feException(print_r(Players::get(2305528)->getBiomeInStorms()));
    Notifications::updateTotalMana();
  }

  function debug_loadUnique($v = null)
  {
    $this->loadUnique($v);
  }

  function loadUnique($v = null, $location = HAND)
  {
    require_once('Cards/unique.php');
    $unique = UNIQUES['hydra:member'][$v ?? 0];
    $properties = Cards::generateUnique($unique);
    Cards::singleCreate([
      'player_id' => Players::getCurrentId(),
      'location' => $location,
      'nbr' => 1,
      'properties' => $properties,
    ]);
    Notifications::refreshUI($this::get()->getAllDatas(true));
    $player = Players::getCurrent();
    Notifications::refreshHand($player, $player->getHand()->ui(), $player->getManaCards()->ui());
    Engine::proceed();
  }
  function debug_randomUnique()
  {
    $properties = Cards::generateRandomUnique(FACTIONS[array_rand(FACTIONS)]);
    Cards::singleCreate([
      'player_id' => Players::getCurrentId(),
      'location' => HAND,
      'nbr' => 1,
      'properties' => $properties,
    ]);
    Notifications::refreshUI($this::get()->getAllDatas(true));
    $player = Players::getCurrent();
    Notifications::refreshHand($player, $player->getHand()->ui(), $player->getManaCards()->ui());
    Engine::proceed();
  }

  function tiebreak()
  {
    Globals::setTieBreakerMode(true);
    $meeples = new Collection();
    foreach (Players::getAll() as $pId => $player) {
      $player->getCompanionToken()->setLocation('storm-4');
      $player->getHeroToken()->setLocation('storm-3');
      $meeples = $meeples->merge(Meeples::getStormTokens($pId));
    }
    // notif startTiebreak
    Notifications::startTiebreak($meeples->toArray());
  }

  function resolveDebug()
  {
    Engine::resolveAction([]);
    Engine::proceed();
  }

  function tapAllMana()
  {
    foreach (Cards::getAll() as $cId => $card) {
      if ($card->getLocation() == MANA) {
        $card->setTapped(true);
      }
    }
  }

  function untapAll()
  {
    Cards::untapAll();
  }

  function allVisible()
  {
    $sql = "UPDATE `cards` set `card_state` = 1 where `card_location` like 'turn%'";
    self::DbQuery($sql);
  }

  function playCardAux($cardId, $doAction = true)
  {
    $player = Players::getCurrent();
    $pId = $player->getId();

    $sql = "SELECT * FROM cards WHERE card_id = '$cardId' LIMIT 1";
    $card = self::getUniqueValueFromDB($sql);

    if (is_null($card)) {
      $sql = "UPDATE cards set card_id = '$cardId' where player_id = $pId AND `card_location` <> 'inPlay' LIMIT 1";
    } else {
      $sql = "UPDATE cards set player_id = $pId where card_id = '$cardId'";
    }
    self::DbQuery($sql);

    if ($doAction) {
      $this->actTakeAtomicAction([$cardId]);
    }
  }

  function addHand($cardId)
  {
    $player = Players::getCurrent();
    $pId = $player->getId();
    $sql = "UPDATE cards set player_id = $pId, card_location = 'hand' where card_id = '$cardId'";
    self::DbQuery($sql);
    Notifications::drawCards($player, new Collection([Cards::get($cardId)]));
    // $this->insertAsChild([
    //   'action' => CHOOSE_ACTION_CARD,
    //   'pId' => $player->getId(),
    // ]);
    // Engine::resolveAction();
    Engine::proceed();
  }

  function playCard($cardId)
  {
    $this->playCardAux($cardId, true);
  }

  function addCard($cardId, $location = 'hand')
  {
    $player = Players::getCurrent();
    $faction = substr($cardId, 0, 2);
    $className = "\\ALT\\Cards\\$faction\\$cardId";
    $card = new $className(null);

    Cards::singleCreate([
      'player_id' => $player->getId(),
      'location' => $location,
      'nbr' => 1,
      'properties' => $card->getProperties(),
    ]);
    Notifications::refreshUI($this::get()->getAllDatas(true));
    $player = Players::getCurrent();
    Notifications::refreshHand($player, $player->getHand()->ui(), $player->getManaCards()->ui());
    Engine::proceed();
  }

  function drawCard($cardId)
  {
    $this->playCardAux($cardId, false);
    $sql = "UPDATE cards set card_location = 'hand' where card_id = '$cardId'";
    self::DbQuery($sql);
  }

  function engDisplay()
  {
    throw new \feException(print_r(Globals::getEngine()));
  }

  function engProceed()
  {
    Engine::proceed();
  }

  /*
   * loadBug: in studio, type loadBug(20762) into the table chat to load a bug report from production
   * client side JavaScript will fetch each URL below in sequence, then refresh the page
   */
  public function loadBug($reportId)
  {
    die("Obsolete");
    $db = explode('_', self::getUniqueValueFromDB("SELECT SUBSTRING_INDEX(DATABASE(), '_', -2)"));
    $game = $db[0];
    $tableId = $db[1];
    self::notifyAllPlayers(
      'loadBug',
      "Trying to load <a href='https://boardgamearena.com/bug?id=$reportId' target='_blank'>bug report $reportId</a>",
      [
        'urls' => [
          // Emulates "load bug report" in control panel
          "https://studio.boardgamearena.com/admin/studio/getSavedGameStateFromProduction.html?game=$game&report_id=$reportId&table_id=$tableId",

          // Emulates "load 1" at this table
          "https://studio.boardgamearena.com/table/table/loadSaveState.html?table=$tableId&state=1",

          // Calls the function below to update SQL
          "https://studio.boardgamearena.com/1/$game/$game/loadBugSQL.html?table=$tableId&report_id=$reportId",

          // Emulates "clear PHP cache" in control panel
          // Needed at the end because BGA is caching player info
          "https://studio.boardgamearena.com/admin/studio/clearGameserverPhpCache.html?game=$game",
        ],
      ]
    );
  }

  /*
   * loadBugSQL: in studio, this is one of the URLs triggered by loadBug() above
   */
  public function loadBugReportSQL($reportId, $studioPlayersIds)
  {
    $players = self::getObjectListFromDb('SELECT player_id FROM player', true);

    // Change for your game
    // We are setting the current state to match the start of a player's turn if it's already game over
    $sql = ['UPDATE global SET global_value=2 WHERE global_id=1 AND global_value=99'];
    $sql[] = 'ALTER TABLE `gamelog` ADD `cancel` TINYINT(1) NOT NULL DEFAULT 0;';
    $map = [];
    foreach ($players as $index => $pId) {
      $studioPlayer = $studioPlayersIds[$index];
      $map[(int) $pId] = (int) $studioPlayer;

      // All games can keep this SQL
      $sql[] = "UPDATE player SET player_id=$studioPlayer WHERE player_id=$pId";
      $sql[] = "UPDATE global SET global_value=$studioPlayer WHERE global_value=$pId";
      $sql[] = "UPDATE stats SET stats_player_id=$studioPlayer WHERE stats_player_id=$pId";

      // Add game-specific SQL update the tables for your game
      $sql[] = "UPDATE meeples SET player_id=$studioPlayer WHERE player_id=$pId";
      $sql[] = "UPDATE cards SET player_id=$studioPlayer WHERE player_id=$pId";
      $sql[] = "UPDATE cards SET card_location='deck-$studioPlayer' WHERE card_location='deck-$pId'";
      $sql[] = "UPDATE cards SET card_location='board-hero-$studioPlayer' WHERE card_location='board-hero-$pId'";
      $sql[] = "UPDATE user_preferences SET player_id=$studioPlayer WHERE player_id=$pId";
    }
    $msg =
      "<b>Loaded <a href='https://boardgamearena.com/bug?id=$reportId' target='_blank'>bug report $reportId</a></b><hr><ul><li>" .
      implode(';</li><li>', $sql) .
      ';</li></ul>';
    self::warn($msg);
    self::notifyAllPlayers('message', $msg, []);

    foreach ($sql as $q) {
      self::DbQuery($q);
    }

    /******************
     *** Fix Globals ***
     ******************/

    // Turn orders
    $turnOrders = Globals::getCustomTurnOrders();
    foreach ($turnOrders as $key => &$order) {
      $t = [];
      foreach ($order['order'] as $pId) {
        $t[] = $map[$pId];
      }
      $order['order'] = $t;
    }
    Globals::setCustomTurnOrders($turnOrders);

    // Engine
    $engine = Globals::getEngine();
    self::loadDebugUpdateEngine($engine, $map);
    Globals::setEngine($engine);

    // First player
    $fp = Globals::getFirstPlayer();
    Globals::setFirstPlayer($map[$fp]);

    // Active player
    $ap = Globals::getActivePId();
    Globals::setActivePId($map[$ap]);

    // firstDayManaSelection
    $t = Globals::getDeckSelection();
    $u = [];
    foreach ($t as $pId => $choice) {
      $u[$map[$pId]] = $choice;
    }
    Globals::setDeckSelection($u);

    // firstDayManaSelection
    $t = Globals::getFirstDayManaSelection();
    $u = [];
    foreach ($t as $pId => $choice) {
      $u[$map[$pId]] = $choice;
    }
    Globals::setFirstDayManaSelection($u);

    // firstDayManaSelection
    $t = Globals::getPlayerDecks();
    $u = [];
    foreach ($t as $pId => $choice) {
      $u[$map[$pId]] = $choice;
    }
    Globals::setPlayerDecks($u);

    // skippedPlayers
    $t = Globals::getSkippedPlayers();
    $u = [];
    foreach ($t as $pId) {
      $u[] = $map[$pId];
    }
    Globals::setSkippedPlayers($u);

    self::reloadPlayersBasicInfos();
  }

  static function walkReplacePId(&$t, $map)
  {
    if (isset($t['pId'])) {
      $t['pId'] = $map[(int) $t['pId']] ?? $t['pId'];
    }
    if (isset($t['pIds'])) {
      foreach ($t['pIds'] as &$pId) {
        $pId = $map[(int) $pId] ?? $pId;
      }
    }

    foreach ($t as $key => &$v) {
      if (is_array($v)) {
        self::walkReplacePId($v, $map);
      }
    }
  }

  static function loadDebugUpdateEngine(&$node, $map)
  {
    if (isset($node['pId'])) {
      $node['pId'] = $map[(int) $node['pId']];
    }
    if (isset($node['args'])) {
      self::walkReplacePId($node['args'], $map);
    }

    if (isset($node['childs'])) {
      foreach ($node['childs'] as &$child) {
        self::loadDebugUpdateEngine($child, $map);
      }
    }
  }
}
