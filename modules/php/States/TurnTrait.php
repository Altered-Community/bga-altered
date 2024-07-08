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

    Globals::setPhase(2);
    Notifications::newPhase(PHASE_AFTERNOON);
    Globals::setStormMoves([]);
    Globals::setAfterRest([]);
    Globals::setPlayedCards(0);
    Globals::setSkippedPlayers([]);
    Globals::setCostReduction([]);
    Globals::setNextCharacterBoost(0);
    Globals::setPlayedForFree(false);

    Globals::setDayPhase(true);
    // Update cards with extra datas set
    foreach (Cards::getAll() as $cId => $card) {
      if (($card->getExtraDatas()['userPower'] ?? false) == true) {
        $dat = $card->getExtraDatas();
        $dat['userPower'] = false;
        $card->setExtraDatas($dat);
      }
    }
    $this->initCustomDefaultTurnOrder('assignment', \ST_ASSIGNMENT, 'stPreBeforeDusk', true);
  }

  /**
   * Activate next player
   */
  function stAssignment()
  {
    $player = Players::getActive();
    if (Players::checkVictory()) {
      Globals::setDayPhase(false);
      $this->endCustomOrder('assignment');
      return;
    }
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
    $reductionsAll = Globals::getCostReduction();
    foreach ($reductionsAll as $pId => &$reductions) {
      foreach ($reductions as $type => &$reduction) {
        if (!isset($reduction['permanent']) || $reduction['permanent'] == false) {
          $reduction['reduction'] = 0;
        }
      }
    }

    Globals::setCostReduction($reductionsAll);
    Globals::setNextCharacterBoost(0);
    Globals::setNextCharacterCost3Anchored(false);
    Globals::setAdditionalEffect([]);
    Globals::setActivePId($player->getId());
    Globals::setNextSpellIsFree(false);
    Globals::setRemoveFleetingIfSpellPlayedHand(false);
    Globals::setRemoveFleetingSpellPlayed(false);
    Globals::setRemoveFleetingCharacterPlayed(false);
    Globals::setPlayedForFree(false);

    self::giveExtraTime($player->getId());

    Stats::incTurns($player);
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
    Globals::setPhase(3);
    Notifications::newPhase(PHASE_DUSK);

    Globals::setStormMoves([]);
    $this->checkCardListeners('BeforeDusk', 'stBeforeDusk');
  }

  function stBeforeDusk()
  {
    if (Globals::getInstantWin() === true) {
      $this->gamestate->jumpToState(ST_PRE_END_OF_GAME);
      return;
    }
    // to see if we need that
    // not sure as Thai said effects are before dusk
    $this->initCustomDefaultTurnOrder('dusk', \ST_DUSK, ST_BEFORE_NIGHT, true);
  }

  // Move companion and hero
  function stDusk()
  {
    Notifications::startDusk();

    // TODO: multiplayer not managed (create pairs and iterate on those)
    $players = Players::getAll();
    $strengths = [STORM_LEFT => [], STORM_RIGHT => []];

    if (Globals::getTieBreakerMode() == false) {
      Players::computeStorm(true);
    } else {
      // Tie breaker mode
      $winners = [
        FOREST => ['pId' => null, 'value' => 0],
        MOUNTAIN => ['pId' => null, 'value' => 0],
        OCEAN => ['pId' => null, 'value' => 0],
      ];
      foreach ($players as $pId => $player) {
        $expeditions = $player->getBiomeStrength(STORMS, true);

        $validBiomes = [FOREST => 0, OCEAN => 0, MOUNTAIN => 0];
        Players::biomesModifier($validBiomes, $player, '');

        foreach (array_keys($validBiomes) as $biome) {
          $value = $expeditions[STORM_LEFT][$biome] + $expeditions[STORM_RIGHT][$biome];
          if ($winners[$biome]['value'] < $value) {
            $winners[$biome]['value'] = $value;
            $winners[$biome]['pId'] = $pId;
          } elseif ($winners[$biome]['value'] == $value) {
            $winners[$biome]['pId'] = null;
          }
        }
      }
      // throw new \feException(print_r($winners));

      $pWin = [];
      $max = 0;
      $victor = null;
      foreach ($winners as $biome => $info) {
        if ($info['pId'] === null) {
          continue;
        }
        $pWin[$info['pId']] = ($pWin[$info['pId']] ?? 0) + 1;
        if ($pWin[$info['pId']] > $max) {
          $max = $pWin[$info['pId']];
          $victor = $info['pId'];
        } elseif ($pWin[$info['pId']] == $max) {
          $victor = null;
        }
      }

      if (!is_null($victor)) {
        $player = Players::get($victor);
        Notifications::winTieBreaker($player, $pWin[$player->getId()]);
        $player->setScore(1);
        Stats::setWinner($player, 1);
        $this->jumpToOrCall(ST_PRE_END_OF_GAME);
        return;
      } else {
        Notifications::message(clienttranslate('No winner is found. New tiebreaker round starts'));
      }
    }

    Notifications::endDusk();
    $this->gamestate->nextState('done');
  }

  function stAfterDusk()
  {
    if (Players::checkVictory()) {
      return;
    }
    $this->checkCardListeners('AfterDusk', 'stBeforeNight');
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
    $cardLeft = [];
    Globals::setPhase(4);
    Notifications::newPhase(PHASE_NIGHT);
    Globals::setStormMoves([]);
    Globals::setSkippedPlayers([]);
    Globals::setPlayedForFree(false);
    $this->initCustomDefaultTurnOrder('nightCleanup', 'stNightCleanup', 'stAfterNightCleanup', true);
  }

  function stNightCleanup()
  {
    $player = Players::getActive();
    $skipped = Globals::getSkippedPlayers();

    if (in_array($player->getId(), $skipped)) {
      $remaining = array_diff(Players::getAll()->getIds(), $skipped);
      if (empty($remaining)) {
        $this->endCustomOrder('nightCleanup');
      } else {
        $this->nextPlayerCustomOrder('nightCleanup');
      }
      return;
    }
    Engine::setup(['type' => NODE_SEQ, 'childs' => []], ['order' => 'nightCleanup']);

    $skipped[] = $player->getId();
    Globals::setSkippedPlayers($skipped);

    $listened = $player->nightCleanup();

    if (Engine::getNextUnresolved() === null) {
      $this->nextPlayerCustomOrder('nightCleanup');
    } else {
      Engine::proceed();
    }
  }

  function stAfterNightCleanup()
  {
    $this->checkCardListeners('BeforeNight', 'stPreNight', []);
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
    $nExceededReserve = max($player->getReserveCards()->count() - $player->getReserveSlots(), 0);
    $nExceededLandmarks = max($player->getLandmarks()->count() - $player->getLandmarkSlots(), 0);
    $needToDiscard = $nExceededReserve > 0 || $nExceededLandmarks > 0;

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
            'source' => RESERVE,
            'destination' => 'discard',
            'n' => $nExceededReserve,
            'special' => 'nightCleanUp',
            'nLandmarks' => $nExceededLandmarks,
          ],
        ],
      ],
    ];

    // Inserting leaf Action card
    Engine::setup($node, ['order' => 'nightPhase']);
    Engine::proceed();
  }
}
