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
    // if (Players::checkVictory()) {
    //   return;
    // }

    Globals::setPhase(2);
    Notifications::newPhase(PHASE_AFTERNOON);
    Globals::setStormMoves([]);
    Globals::setAfterRest([]);
    Globals::setAfterNightCleanup([]);
    Globals::setPlayedCards(0);
    Globals::setSkippedPlayers([]);
    Globals::setCostReduction([]);
    Globals::setNextCharacterBoost(0);
    Globals::setNextCharacterBoostOccurence(0);
    Globals::setNextReserveCharacterBoost(0);
    Globals::setPlayedForFree(false);
    Globals::setNextCharacterInExpeditionBoost([]);

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
    // if (Players::checkVictory()) {
    //   Globals::setDayPhase(false);
    //   $this->endCustomOrder('assignment');
    //   return;
    // }
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
    Globals::setNextCharacterBoostOccurence(0);
    Globals::setNextReserveCharacterBoost(0);
    Globals::setNextCharacterCost3Anchored(false);
    Globals::setNextCharacterBaseCost3Anchored(false);
    Globals::setNextCharacterAnchored(false);
    Globals::setNextCharacterFleeting(false);
    Globals::setNextTokenAnchored(false);
    Globals::setNextTokenAsleep(false);
    Globals::setAdditionalEffect([]);
    Globals::setActivePId($player->getId());
    Globals::setNextSpellIsFree(false);
    Globals::setRemoveFleetingIfSpellPlayedHand(false);
    Globals::setRemoveFleetingSpellPlayed(false);
    Globals::setRemoveFleetingCharacterPlayed(false);
    Globals::setRemoveFleetingCharacterStat0Played(false);
    Globals::setRemoveFleetingSongArtistPlayed(false);
    Globals::setPlayedForFree(false);
    Globals::setNextCharacterBoostV(0);
    Globals::setNextCharacterInExpeditionBoost([]);

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
    // if (Players::checkVictory()) {
    //   return;
    // }
    Globals::setPhase(3);
    Notifications::newPhase(PHASE_DUSK);

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
    Globals::setNextCharacterBoostOccurence(0);
    Globals::setNextReserveCharacterBoost(0);
    Globals::setNextCharacterCost3Anchored(false);
    Globals::setNextCharacterAnchored(false);
    Globals::setNextCharacterFleeting(false);
    Globals::setNextTokenAnchored(false);
    Globals::setNextTokenAsleep(false);
    Globals::setAdditionalEffect([]);
    Globals::setNextSpellIsFree(false);
    Globals::setRemoveFleetingIfSpellPlayedHand(false);
    Globals::setRemoveFleetingSpellPlayed(false);
    Globals::setRemoveFleetingCharacterPlayed(false);
    Globals::setRemoveFleetingCharacterStat0Played(false);
    Globals::setRemoveFleetingSongArtistPlayed(false);
    Globals::setPlayedForFree(false);
    Globals::setNextCharacterBoostV(0);

    Globals::setStormMoves([]);
    $this->checkCardListeners('BeforeDusk', 'stBeforeDusk');
  }

  function stBeforeDusk()
  {
    if (Globals::getInstantWin() === true) {
      $this->gamestate->jumpToState(ST_PRE_END_OF_GAME);
      return;
    }
    $this->checkCardListeners('AtDusk', 'stDusk');
  }

  function stDusk()
  {
    $this->initCustomTurnOrder('advancePhase', [Players::getActiveId()],  'stAdvanceDusk', 'stAfterDusk');
  }

  // Move companion and hero
  function stAdvanceDusk()
  {
    Notifications::startDusk();

    // TODO: multiplayer not managed (create pairs and iterate on those)
    $players = Players::getAll();
    $strengths = [STORM_LEFT => [], STORM_RIGHT => []];

    if (Globals::getTieBreakerMode() == false) {
      Engine::setup(['type' => NODE_SEQ, 'childs' => []], ['order' => 'advancePhase']);
      Players::computeStorm(true);
      Engine::proceed();
    } else {
      // Tie breaker mode
      $winners = [
        FOREST => ['pId' => null, 'value' => 0],
        MOUNTAIN => ['pId' => null, 'value' => 0],
        OCEAN => ['pId' => null, 'value' => 0],
      ];

      $region = null;
      $markers = Meeples::getOfType('storm-4', [OCEAN, FOREST, MOUNTAIN])->sortBy('state');
      if ($markers->count() > 0) {
        foreach ($markers as $mId => $marker) {
          $region =  $marker->getType();
        }
      }

      foreach ($players as $pId => $player) {
        $expeditions = $player->getBiomeStrength(STORMS, true);

        $validBiomes = [FOREST => 0, OCEAN => 0, MOUNTAIN => 0];
        if (!is_null($region)) {
          $validBiomes = [$region => 0];
        }
        Players::biomesModifier($validBiomes, $player, '', true);

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
        Stats::setGameWinner(Players::get($victor)->getHero()->getStatData());
        Stats::setGameLooser(Players::getNext(Players::get($victor))->getHero()->getStatData());
        $this->jumpToOrCall(ST_PRE_END_OF_GAME);
        return;
      } else {
        Notifications::message(clienttranslate('No winner is found. New tiebreaker round starts'));
      }
      $this->stAfterDusk();
    }

    // Notifications::endDusk();
    // $this->stAfterDusk();
  }

  function stAfterDusk()
  {
    Notifications::endDusk();
    // if (Players::checkVictory()) {
    //   return;
    // }

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
    // if (Players::checkVictory()) {
    //   return;
    // }
    // if (Globals::isEnterTieBreakerMode()) {
    //   Globals::setTieBreakerMode(true);
    //   Globals::setEnterTieBreakerMode(false);
    // }
    Globals::setPhase(4);
    Notifications::newPhase(PHASE_NIGHT);
    Globals::setPlayedForFree(false);

    // We initiate a turn order for only 1 player as everything will follow from those
    $this->initCustomTurnOrder('nightCleanup', [Players::getActiveId()],  'stNightCleanup', 'stAfterNightCleanup');
  }

  function stNightCleanup()
  {
    // $player = Players::getActive();

    // Initiate engine in case some cards are reacting
    Engine::setup(['type' => NODE_SEQ, 'childs' => []], ['order' => 'nightCleanup']);
    // Move cards / remove tokens => possible reaction of cards moving to reserve or being discarded
    $turnOrder = Players::getTurnOrder();
    foreach ($turnOrder as $pId) {
      Players::get($pId)->nightCleanup();
    }
    // foreach (Players::getAll() as $pId => $player) {
    //   $player->nightCleanup();
    // }
    Globals::setActivePId(Globals::getFirstPlayer());
    $this->gamestate->changeActivePlayer(Globals::getFirstPlayer());
    Engine::proceed();
  }

  function stAfterNightCleanup()
  {
    Meeples::nightCleanup();
    Globals::setStormMoves([]); // moved to be able to test Expedition cleanup
    $this->checkCardListeners('BeforeNight', 'stPreNight', []);
  }

  function stPreNight()
  {
    Globals::setPlayedCards(1);
    $this->initCustomDefaultTurnOrder('nightPhase', 'stNight', ST_END_OF_NIGHT);
  }

  public function stNight()
  {
    $player = Players::getActive();

    // Need to discard ?
    $nExceededLandmarks = max($player->getLandmarks()->count() - $player->getLandmarkSlots(), 0);

    $exhaustedReserveCards = $player->getReserveCards()->filter(function ($c) {
      return $c->isTapped();
    })->count();

    $exhaustedReserveSlots = $player->getExhaustedReserveSlots();
    $nExceededReserve = max($player->getReserveCards()->count() - $player->getReserveSlots(), 0);
    if ($nExceededReserve > 0 && $exhaustedReserveSlots > 0) {
      // if there are some exhausted slots, we can reduce the exceeding reserve linked to the status
      $nExceededReserve -= min($exhaustedReserveCards, $exhaustedReserveSlots);
    }
    $nExceededReserve = max($nExceededReserve, 0);
    $needToDiscard = $nExceededReserve > 0 || $nExceededLandmarks > 0;

    if (!$needToDiscard) {
      $this->nextPlayerCustomOrder('nightPhase');
      return;
    }

    self::giveExtraTime($player->getId(), 20);
    $node = [
      'childs' => [
        [
          'action' => NIGHT_CLEANUP,
          'pId' => $player->getId(),
          'args' => [
            'destination' => 'discard',
            'nReserve' => $nExceededReserve,
            'nLandmarks' => $nExceededLandmarks,
          ],
        ],
      ],
    ];
    Engine::setup($node, ['order' => 'nightPhase']);
    Engine::proceed();
  }

  function stEndOfNight()
  {
    // throw new \feException(print_r(Globals::getAfterNightCleanup()));

    $this->checkCardListeners('EndOfNight', ST_NEW_DAY);
  }
}
