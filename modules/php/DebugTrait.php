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
use ALT\Helpers\Collection;

trait DebugTrait
{
  function tp()
  {
    $players = self::loadPlayersBasicInfos();
    Cards::setupNewGame($players, []);
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
    // $this->actTakeAtomicAction('actMemory', [29, STORM_LEFT]);
    // $this->actTakeAtomicAction('actEcho', [226]);
    $this->actTakeAtomicAction('actTap', [236]);
    // $this->actTakeAtomicAction('actPass', []);
    // $this->actTakeAtomicAction('actDiscard', [[9]]);
    // $this->actTakeAtomicAction('actTarget', [[17]]);
    // $this->actTakeAtomicAction('actInvokeToken', [STORM_LEFT]);

    // throw new \feException(Cards::get(11)->countToken(FLEETING));
  }

  function tv()
  {
    // Cards::get(24)->setTapped(true);
    // Cards::get(3)->setEffectHand([[TARGET_ALL_CHARACTER_2 => [[BOOST => 2], [BOOST => 2]]]]);
    Cards::get(32)->setEffectPassive([
      'ChooseAssignment' => [
        'condition' => 'firstCharacterPlayed',
        'output' => FT::SEQ(FT::GAIN(EFFECT, BOOST), ['action' => SPECIAL_EFFECT, 'args' => ['effect' => 'useCard']]),
      ],
    ]);
    // Cards::get(1)->isListeningTo([]);
  }

  function score($cardId)
  {
    $card = ZooCards::get($cardId);
    if (!$card->isPlayed()) {
      throw new \feException('not played');
    }

    $card->score();
  }

  function resolveDebug()
  {
    Engine::resolveAction([]);
    Engine::proceed();
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
    self::playCardAux($cardId, true);
  }

  function addCard($cardId)
  {
    self::playCardAux($cardId, false);
    $sql = "UPDATE cards set card_location = 'inPlay' where card_id = '$cardId'";
    self::DbQuery($sql);
  }

  function drawCard($cardId)
  {
    self::playCardAux($cardId, false);
    $sql = "UPDATE cards set card_location = 'hand' where card_id = '$cardId'";
    self::DbQuery($sql);
  }

  function engSetup()
  {
    $pId = Players::getAll()->getIds()[0];

    Engine::setup([
      'childs' => [
        [
          'state' => ST_PLACE_FARMER,
          'pId' => $pId,
          'mandatory' => true,
        ],
      ],
    ]);
  }

  function engDisplay()
  {
    var_dump(Globals::getEngine());
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
  public function loadBugSQL($reportId)
  {
    $studioPlayer = self::getCurrentPlayerId();
    $players = self::getObjectListFromDb('SELECT player_id FROM player', true);

    // Change for your game
    // We are setting the current state to match the start of a player's turn if it's already game over
    $sql = ['UPDATE global SET global_value=2 WHERE global_id=1 AND global_value=99'];
    $sql[] = 'ALTER TABLE `gamelog` ADD `cancel` TINYINT(1) NOT NULL DEFAULT 0;';
    $map = [];
    foreach ($players as $pId) {
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
      // $sql[] = "UPDATE actioncards SET player_id=$studioPlayer WHERE player_id=$pId";
      // $sql[] = "UPDATE buildings SET player_id=$studioPlayer WHERE player_id=$pId";
      // $sql[] = "UPDATE user_preferences SET player_id=$studioPlayer WHERE player_id=$pId";

      // This could be improved, it assumes you had sequential studio accounts before loading
      // e.g., quietmint0, quietmint1, quietmint2, etc. are at the table
      $studioPlayer++;
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

    self::reloadPlayersBasicInfos();
  }

  function loadDebugUpdateEngine(&$node, $map)
  {
    if (isset($node['pId'])) {
      $node['pId'] = $map[(int) $node['pId']];
    }

    if (isset($node['childs'])) {
      foreach ($node['childs'] as &$child) {
        self::loadDebugUpdateEngine($child, $map);
      }
    }
  }
}
