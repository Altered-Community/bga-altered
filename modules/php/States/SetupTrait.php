<?php
namespace ALT\States;
use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Core\Engine;
use ALT\Core\Stats;
use ALT\Core\Preferences;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Managers\Meeples;
use ALT\Helpers\Log;

trait SetupTrait
{
  /*
   * setupNewGame:
   */
  protected function setupNewGame($players, $options = [])
  {
    // Globals::setupNewGame($players, $options);
    // Players::setupNewGame($players, $options);
    // Preferences::setupNewGame($players, $this->player_preferences);
    // ZooCards::setupNewGame($players, $options);
    // Meeples::setupNewGame($players, $options);
    // Stats::checkExistence();

    // Globals::setFirstPlayer($this->getNextPlayerTable()[0]);

    $this->setGameStateInitialValue('logging', false);
    $this->activeNextPlayer();
  }

  protected function setupPlayer($player, $notif = false)
  {
    $pId = $player->getId();
    $meeples = Meeples::setupPlayer($pId);
    // $cards = ActionCards::setupPlayer($pId);

    // // Create buildings for map A
    // $buildings = [];
    // $mapId = $player->getMapId();
    // Stats::setMap($player, $mapId == 'A' ? 100 : ((int) $mapId));
    // if ($mapId == 'A') {
    //   $buildings[] = Buildings::add($pId, 'size-3', ['x' => 0, 'y' => 9], 0);
    //   $buildings[] = Buildings::add($pId, 'kiosk', ['x' => 0, 'y' => 7], 0);
    //   Stats::incBuiltEnclosures($pId);
    //   Stats::incBuiltKiosks($pId);
    //   Stats::incCoveredHexes($pId, 4);
    // }

    // if ($notif) {
    //   Notifications::setupPlayer($player, $mapId, $cards, $meeples, $buildings);
    // }
  }

  // Deck selection
  function argsDeckSelection()
  {
    return [];
  }
}
