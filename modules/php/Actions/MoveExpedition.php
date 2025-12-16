<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Helpers\FT;
use ALT\Core\Engine;

class MoveExpedition extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_MOVE_EXPEDITION;
  }

  public function getDescription()
  {
    return clienttranslate('Move expedition');
  }

  protected $args = [
    'expedition' => [],
    'n' => 1,
    'pId' => null,
    'force' => false,
    'forceExpedition' => null,
    'winningBiomes' => [],
    'moveOtherExpedition' => false,
    'ascended' => false,
  ];

  public function getSides()
  {
    $expeditions = $this->getArg('expedition');
    if (empty($expeditions)) {
      $expeditions = STORMS;
    }

    if (is_string($expeditions)) {
      $expeditions = [$expeditions];
    }

    foreach ($expeditions as &$expe) {
      if ($expe == EFFECT) {
        $expe = $this->getSource()->getLocation();
      } elseif ($expe == 'fromEvent') {
        // Check event in case of leaving expedition
        $event = $this->getEventRecursive();
        if (!is_null($event) && in_array($event['method'], ['LeaveExpedition', 'LeaveLandmark']) && isset($event['from'])) {
          $expe = $event['from'];
        }
      }
    }

    return $expeditions;
  }

  public function argsMoveExpedition()
  {
    $sides = $this->getSides();
    $n = $this->getArg('n');
    $forceExpedition = $this->getArg('forceExpedition');
    if (!is_null($forceExpedition)) {
      $expeditions = $forceExpedition;
    } else {
      $forcedPId = $this->getArg('pId');
      if ($forcedPId == OPPONENT) {
        $forcedPId = Players::getNextId(Players::getActive());
      } elseif ($forcedPId == ME) {
        $forcedPId = Players::getActiveId();
      }
      $blocked = Players::getBlockedExpeditions();

      $expeditions = [];
      foreach ($blocked as $pId => $statuses) {
        if (!is_null($forcedPId) && $forcedPId != $pId) {
          continue;
        }
        foreach ($statuses as $side => $isBlocked) {
          if (in_array($side, $sides) && ($n < 0 || !$isBlocked)) {
            $expeditions[] = [$pId, $side];
          }
        }
      }
    }
    return [
      'forceExpedition' => $this->getArg('forceExpedition'),
      'expeditions' => $expeditions,
      'descSuffix' => $n < 0 ? "backward" : "",
    ];
  }

  public function isDoable($player)
  {
    $args = $this->argsMoveExpedition();
    return !empty($args['expeditions']);
  }

  public function isAutomatic($player = null)
  {
    $args = $this->argsMoveExpedition();
    return count($args['expeditions']) == 1;
  }

  public function stMoveExpedition()
  {
    if (Globals::isTieBreakerMode()) {
      Notifications::message(clienttranslate('In tie-breaker this power has no effect.'), []);
      $this->resolveAction(null);
      return;
    }

    if (!is_null($this->getArg('forceExpedition'))) {
      return $this->getArg('forceExpedition');
    }

    $args = $this->argsMoveExpedition();
    if (count($args['expeditions']) == 1) {
      return [$args['expeditions'][0]];
    }
  }

  public function actMoveExpedition($expe)
  {
    $args = $this->argsMoveExpedition();
    $gigantic = false;
    if (!in_array($expe, $args['expeditions'])) {
      throw new \BgaVisibleSystemException('Invalid expedition all. Should not happen');
    }

    if (!is_null($this->getSource()) && $this->getSource()->isGigantic()) {
      $gigantic = true;
    }

    // Combo Diocles & eat me energy bars
    $event = $this->getEvent();
    if ($event['method'] == 'LeaveExpedition' && $event['gigantic'] == true) {
      $gigantic = true;
    }

    if (!is_null($this->getArg('forceExpedition'))) {
      $expe = $this->getArg('forceExpedition');
    }

    $pId = $expe[0];
    $expedition = $expe[1];
    // throw new \feException("titi");
    $token = $expedition == STORM_LEFT ? HERO : COMPANION;
    $source = $this->getSource();
    $n = $this->getArg('n');
    $player = Players::get($pId);
    $winningBiomes = $this->getArg('winningBiomes');
    $ascended = $player->isAscended($expedition);

    // Rune's testament
    if ($this->getArg('force') === false) {
      $actionInsteadAdvance = Players::getActionInsteadOfAdvance();
      if ($n > 0 && !empty($actionInsteadAdvance[$pId][$expedition] ?? [])) {
        $nodes = [];
        if (!in_array('ErisCommon', $actionInsteadAdvance[$pId][$expedition]) && !in_array('ErisRare', $actionInsteadAdvance[$pId][$expedition])) {
          $nodes[] = FT::ACTION(MOVE_EXPEDITION, ['pId' => $pId, 'expedition' => [$expedition], 'force' => true, 'n' => $n, 'winningBiomes' => $winningBiomes], ['pId' => $pId]);
        }
        foreach ($actionInsteadAdvance[$pId][$expedition] as $cId => $action) {
          $triggeredCard = Cards::get($cId);
          if ($action == 'draw2') {
            $nodes[] =
              FT::SEQ(
                FT::ACTION(DISCARD, ['cardId' => $cId], ['sourceId' => $cId]),
                FT::ACTION(DRAW, ['players' => ME, 'n' => 2], ['pId' => $pId, 'sourceId' => $cId])
              );
          } elseif ($action == 'look4') {
            $nodes[] =  FT::SEQ(
              FT::ACTION(DISCARD, ['cardId' => $cId], ['sourceId' => $cId]),
              FT::ACTION(SPECIAL_EFFECT, ['effect' => 'RunesTestamentLook4'], ['pId' => $pId, 'sourceId' => $cId])
            );
          } elseif ($action == 'ErisCommon') {
            if (!$triggeredCard->isGigantic()) {
              $nodes[] = FT::ACTION(ROLL_DIE, [
                'effect' => [
                  '1-3' => FT::ACTION(MOVE_EXPEDITION, ['pId' => $pId, 'expedition' => [$expedition], 'force' => true, 'n' => $n, 'winningBiomes' => $winningBiomes], ['pId' => $pId]),
                  '4+' => FT::ACTION(MOVE_EXPEDITION, ['pId' => $pId, 'expedition' => [$expedition], 'force' => true, 'n' => $n + 1, 'winningBiomes' => $winningBiomes], ['pId' => $pId])
                ]
              ], ['sourceId' => $cId]);
            } else {
              $nodes[] = FT::ACTION(MOVE_EXPEDITION, ['pId' => $pId, 'expedition' => [$expedition], 'force' => true, 'n' => $n, 'winningBiomes' => $winningBiomes, 'ascended' => $isAscended], ['pId' => $pId]);
            }
          } elseif ($action == 'ErisRare') {
            if (!$triggeredCard->isGigantic()) {
              $nodes[] = FT::ACTION(ROLL_DIE, [
                'effect' => [
                  '2-3' => FT::ACTION(MOVE_EXPEDITION, ['pId' => $pId, 'expedition' => [$expedition], 'force' => true, 'n' => $n, 'winningBiomes' => $winningBiomes], ['pId' => $pId]),
                  '4+' => FT::ACTION(MOVE_EXPEDITION, ['pId' => $pId, 'expedition' => [$expedition], 'force' => true, 'n' => $n + 1, 'winningBiomes' => $winningBiomes], ['pId' => $pId])
                ]
              ], ['sourceId' => $cId]);
            } else {
              $nodes[] = FT::ACTION(MOVE_EXPEDITION, ['pId' => $pId, 'expedition' => [$expedition], 'force' => true, 'n' => $n, 'winningBiomes' => $winningBiomes, 'ascended' => $isAscended], ['pId' => $pId]);
            }
          }
        }
        Engine::insertAsChild(
          ['type' => NODE_XOR, 'childs' => $nodes, 'pId' => $pId]
        );

        $this->resolveAction(['']);
        return;
      }
    }
    $winningBiomes = $this->getArg('winningBiomes');
    if (($n > 0 && !Players::hasOpponentBlockMoveExpedition($player, $expedition)) || $n < 0) {
      $moved = $player->advanceStorm($token, $winningBiomes, $n, true, $source);
    } else {
      $moved = false;
    }
    if ($moved) {
      $this->checkAfterListeners($player, ['moveExpedition' => $n, 'ascended' => $ascended, 'expedition' => $expedition]);
      if ($this->getArg('moveOtherExpedition') === true) {
        // only done through a spell
        $otherExpedition = $expedition == STORM_LEFT ? STORM_RIGHT : STORM_LEFT;
        if ((($n * -1) > 0 && !Players::hasOpponentBlockMoveExpedition($player, $otherExpedition)) || ($n * -1) < 0) {
          $moved = $player->advanceStorm($token == HERO ? COMPANION : HERO, $winningBiomes, $n * -1, true, $source);
          $this->checkAfterListeners($player, ['moveExpedition' => $n * -1, 'ascended' => $player->isAscended($otherExpedition), 'expedition' => $otherExpedition]);
        }
      }
    }

    if ($gigantic) {
      // we must move the other expedition
      $expedition = $expedition == STORM_LEFT ? STORM_RIGHT : STORM_LEFT;

      $token = $expedition == STORM_LEFT ? HERO : COMPANION;
      if (($n > 0 && !Players::hasOpponentBlockMoveExpedition($player, $expedition)) || $n < 0) {
        $moved = $player->advanceStorm($token, $winningBiomes, $n, true, $source);
        if ($moved) {
          $this->checkAfterListeners($player, ['moveExpedition' => $n, 'ascended' => $player->isAscended($expedition), 'expedition' => $expedition]);
        }
      }
    }
  }
}
