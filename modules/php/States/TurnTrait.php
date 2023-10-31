<?php
namespace ALT\States;
use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Core\Engine;
use ALT\Core\Stats;
use ALT\Helpers\Log;
use ALT\Managers\Players;
use ALT\Managers\Meeples;
use ALT\Managers\Cards;

trait TurnTrait
{
  function actOrderCards($cardIds)
  {
    $player = Players::getCurrent();
    foreach ($cardIds as $i => $cardId) {
      $card = Cards::getSingle($cardId);
      if (is_null($card) || $card->isPlayed() || $card->getPId() != $player->getId()) {
        throw new \BgaVisibleSystemException("You can't reorder that card:" . $card->getId());
      }

      Cards::setState($cardId, $i);
    }
  }

  ///////////////////////////////
  //  ____  _             _
  // / ___|| |_ __ _ _ __| |_
  // \___ \| __/ _` | '__| __|
  //  ___) | || (_| | |  | |_
  // |____/ \__\__,_|_|   \__|
  ///////////////////////////////

  /**
   * State function when starting a turn
   */
  function stBeforeAssignment()
  {
    if (Players::checkVictory()) {
      return;
    }

    Globals::setStormMoves([]);
    Globals::setPlayedCards(0);
    Globals::setSkippedPlayers([]);
    Globals::setDayPhase(true);
    // Update cards with extra datas set
    foreach (Cards::getAll() as $cId => $card) {
      if (($card->getExtraDatas()['userPower'] ?? false) == true) {
        $dat = $card->getExtraDatas();
        $dat['userPower'] = false;
        $card->setExtraDatas($dat);
      }
    }
    $this->initCustomDefaultTurnOrder('assignment', \ST_ASSIGNMENT, ST_PRE_DUSK_PHASE, true);
  }

  /**
   * Activate next player
   */
  function stAssignment()
  {
    $player = Players::getActive();

    // check if a player skipped his turn
    $skipped = Globals::getSkippedPlayers();
    if (in_array($player->getId(), $skipped)) {
      // Everyone is out of round => end it
      $remaining = array_diff(Players::getAll()->getIds(), $skipped);
      if (empty($remaining)) {
        Globals::setDayPhase(false);
        $this->endCustomOrder('assignment');
      } else {
        $this->nextPlayerCustomOrder('assignment');
      }
      return;
    }

    Globals::setPlayedCards(0);
    self::giveExtraTime($player->getId());

    // Stats::incTurns($player);
    $node = [
      'childs' => [
        [
          'action' => CHOOSE_ASSIGNMENT,
          'pId' => $player->getId(),
        ],
      ],
    ];

    // Inserting leaf Action card
    Engine::setup($node, ['order' => 'assignment']);
    Engine::proceed();
  }

  ////////////////////////////
  //  ____            _
  // |  _ \ _   _ ___| | __
  // | | | | | | / __| |/ /
  // | |_| | |_| \__ \   <
  // |____/ \__,_|___/_|\_\
  ////////////////////////////

  function stPreBeforeDusk()
  {
    if (Players::checkVictory()) {
      return;
    }

    Globals::setStormMoves([]);
    $this->checkCardListeners('BeforeDusk', 'stBeforeDusk');
  }

  function stBeforeDusk()
  {
    // to see if we need that
    // not sure as Thai said effects are before dusk
    $this->initCustomDefaultTurnOrder('dusk', \ST_DUSK, ST_BEFORE_NIGHT, true);
  }

  // Move companion and hero
  function stDusk()
  {
    // TODO: multiplayer not managed (create pairs and iterate on those)
    $players = Players::getAll();
    $strengths = [STORM_LEFT => [], STORM_RIGHT => []];
    $winners = [
      STORM_LEFT => [
        FOREST => ['pId' => null, 'value' => 0],
        MOUNTAIN => ['pId' => null, 'value' => 0],
        OCEAN => ['pId' => null, 'value' => 0],
      ],
      STORM_RIGHT => [
        FOREST => ['pId' => null, 'value' => 0],
        MOUNTAIN => ['pId' => null, 'value' => 0],
        OCEAN => ['pId' => null, 'value' => 0],
      ],
    ];

    // Winner calculation
    foreach ($players as $pId => $player) {
      $expeditions = $player->getBiomeStrength(STORMS, true);
      foreach ($expeditions as $expedition => $biomes) {
        foreach ($biomes as $biome => $value) {
          if ($winners[$expedition][$biome]['value'] < $value) {
            $winners[$expedition][$biome]['value'] = $value;
            $winners[$expedition][$biome]['pId'] = $pId;
          } elseif ($winners[$expedition][$biome]['value'] == $value) {
            $winners[$expedition][$biome]['pId'] = null;
          }
        }
      }
    }

    // For each player, check whether hero and/or companion move forward
    foreach ($players as $pId => $player) {
      $biomesByStorm = $player->getBiomeInStorms();
      foreach ($biomesByStorm as $side => $biomes) {
        $move = null;
        $expedition = $side == ALTERATEUR ? STORM_LEFT : STORM_RIGHT;

        foreach ($biomes as $i => $biome) {
          if ($winners[$expedition][$biome]['pId'] == $pId) {
            $move = $biome;
          }
          if ($move !== null) {
            break;
          }
        }
        if ($move !== null) {
          $player->advanceStorm($side, $move);
        }
      }
    }
    $this->gamestate->nextState('done');
  }

  ////////////////////////////////
  //  _   _ _       _     _
  // | \ | (_) __ _| |__ | |_
  // |  \| | |/ _` | '_ \| __|
  // | |\  | | (_| | | | | |_
  // |_| \_|_|\__, |_| |_|\__|
  //          |___/
  ////////////////////////////////

  function stBeforeNight()
  {
    if (Players::checkVictory()) {
      return;
    }

    Globals::setStormMoves([]);
    foreach (Players::getAll() as $pId => $player) {
      $player->nightCleanup();
    }
    $this->checkCardListeners('BeforeNight', 'stPreNight');
  }

  function stPreNight()
  {
    Globals::setSkippedPlayers([]);
    Globals::setPlayedCards(1);
    $this->initCustomDefaultTurnOrder('nightPhase', \ST_NIGHT, ST_NEW_DAY, true);
  }

  public function stNight()
  {
    $player = Players::getActive();
    // check if a player skipped his turn
    $skipped = Globals::getSkippedPlayers();

    if (in_array($player->getId(), $skipped)) {
      // Everyone has discarded
      $remaining = array_diff(Players::getAll()->getIds(), $skipped);
      if (empty($remaining)) {
        $this->endCustomOrder('nightPhase');
      } else {
        $this->nextPlayerCustomOrder('nightPhase');
      }
      return;
    }

    // if the player has no need to discard
    $nExceededMemory = $player->getMemoryCards()->count() - $player->getMemorySlots();
    $needToDiscard = $nExceededMemory > 0;

    if (!$needToDiscard) {
      $skipped[] = $player->getId();
      Globals::setSkippedPlayers($skipped);
      $this->nextPlayerCustomOrder('nightPhase');
      return;
    }

    self::giveExtraTime($player->getId(), 20);

    // Stats::incTurns($player);
    $node = [
      'childs' => [
        [
          'action' => DISCARD,
          'pId' => $player->getId(),
          'args' => [
            'source' => MEMORY,
            'destination' => 'discard',
            'n' => $nExceededMemory,
          ],
        ],
      ],
    ];

    // Inserting leaf Action card
    Engine::setup($node, ['order' => 'nightPhase']);
    Engine::proceed();
  }
}
