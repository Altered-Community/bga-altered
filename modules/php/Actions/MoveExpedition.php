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
    'winningBiomes' => null,
  ];

  public function getSides()
  {
    $expeditions = $this->getArg('expedition');
    if (empty($expeditions)) {
      $expeditions = STORMS;
    }

    foreach ($expeditions as &$expe) {
      if ($expe == EFFECT) {
        $expe = $this->getSource()->getLocation();
      }
    }

    return $expeditions;
  }

  public function argsMoveExpedition()
  {
    $sides = $this->getSides();
    $n = $this->getArg('n');
    $forcedPId = $this->getArg('pId');
    if ($forcedPId == OPPONENT) {
      $forcedPId = Players::getNextId(Players::getActive());
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

    return [
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

    $pId = $expe[0];
    $expedition = $expe[1];

    $token = $expedition == STORM_LEFT ? HERO : COMPANION;
    $source = $this->getSource();
    $n = $this->getArg('n');
    $player = Players::get($pId);

    // Rune's testament
    if ($this->getArg('force') === false) {
      $actionInsteadAdvance = Players::getActionInsteadOfAdvance();
      if ($n > 0 && !empty($actionInsteadAdvance[$pId][$expedition] ?? [])) {
        $nodes = [];
        if (!in_array('ErisCommon', $actionInsteadAdvance[$pId][$expedition]) && !in_array('ErisRare', $actionInsteadAdvance[$pId][$expedition])) {
          $nodes[] = FT::ACTION(MOVE_EXPEDITION, ['pId' => $pId, 'expedition' => [$expedition], 'force' => true, 'n' => $n, 'winningBiomes' => $winningBiomes], ['pId' => $pId]);
        }
        foreach ($actionInsteadAdvance[$pId][$expedition] as $cId => $action) {
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
            $nodes[] = FT::ACTION(ROLL_DIE, [
              'effect' => [
                '1-3' => FT::ACTION(MOVE_EXPEDITION, ['pId' => $pId, 'expedition' => [$expedition], 'force' => true, 'n' => $n, 'winningBiomes' => $winningBiomes], ['pId' => $pId]),
                '4+' => FT::ACTION(MOVE_EXPEDITION, ['pId' => $pId, 'expedition' => [$expedition], 'force' => true, 'n' => $n + 1, 'winningBiomes' => $winningBiomes], ['pId' => $pId])
              ]
            ], ['sourceId' => $cId]);
          } elseif ($action == 'ErisRare') {
            $nodes[] = FT::ACTION(ROLL_DIE, [
              'effect' => [
                '2-3' => FT::ACTION(MOVE_EXPEDITION, ['pId' => $pId, 'expedition' => [$expedition], 'force' => true, 'n' => $n, 'winningBiomes' => $winningBiomes], ['pId' => $pId]),
                '4+' => FT::ACTION(MOVE_EXPEDITION, ['pId' => $pId, 'expedition' => [$expedition], 'force' => true, 'n' => $n + 1, 'winningBiomes' => $winningBiomes], ['pId' => $pId])
              ]
            ], ['sourceId' => $cId]);
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
    $player->advanceStorm($token, $winningBiomes, $n, true, $source);
    $this->checkAfterListeners($player, ['moveExpedition' => $n]);

    if ($gigantic) {
      // we must move the other expedition
      $expedition = $expedition == STORM_LEFT ? STORM_RIGHT : STORM_LEFT;

      $token = $expedition == STORM_LEFT ? HERO : COMPANION;

      $player->advanceStorm($token, $winningBiomes, $n, true, $source);
      $this->checkAfterListeners($player, ['moveExpedition' => $n]);
    }
  }
}
