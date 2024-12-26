<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Managers\ActionCards;
use ALT\Core\Engine;
use ALT\Core\Globals;
use ALT\Core\Stats;
use ALT\Helpers\Conditions;
use ALT\Helpers\Utils;
use ALT\Models\Player;

class CheckCondition extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_CHECK_CONDITION;
  }

  protected $args = ['condition' => null, 'effect' => null, 'oppositeEffect' => null];

  public function getConditions()
  {
    $conditions = $this->getCtxArg('conditions');
    if (!is_null($conditions)) {
      return $conditions;
    } else {
      $cond = $this->getArg('condition');
      return is_array($cond) ? $cond : [$cond];
    }
  }

  public function getDescription()
  {
    $conditions = $this->getConditions();
    $desc = $this->getCtxArg('description');
    foreach ($conditions as $condition) {
      if ($condition == 'hasBoost:4:LTE') {
        $desc = ['log' => clienttranslate('Check if there are less than 4 <BOOST>'), 'args' => []];
      }
    }
    if ($desc == null) {
      $desc = ['log' => clienttranslate('Check the conditions of the played card'), 'args' => []];
    }
    return $desc;
  }

  public function isIndependent($player = null)
  {
    $cards = Cards::getPlayedCards(null);
    $conditions = $this->getConditions();
    foreach ($cards as $cId => $card) {
      $block = $card->getBlockAutomaticAction();
      if (isset($block[CHECK_CONDITION])) {

        if (!empty(array_intersect($block[CHECK_CONDITION], $conditions))) {
          return false;
        }
      }
    }

    return true;
  }

  public function isDoable($player)
  {
    return $this->checkCondition($player) || (!is_null($this->getArg('oppositeEffect') && $this->getArg('oppositeEffect') != 'OPPOSITE'));
  }

  public function checkCondition($player)
  {
    $source = $this->getSource();
    $event = ['pId' => $player->getId()];
    $card = $source ?? $player->getHero();
    $ctxArgs = $this->getCtxArgs();
    if (isset($ctxArgs['cardFrom'])) {
      $event['cardFrom'] = $ctxArgs['cardFrom'];
    }
    return Conditions::check($ctxArgs, $card, $event);
  }

  public function stCheckCondition()
  {
    $player = Players::getActive();

    $node = $this->getArg('effect');

    if ($this->checkCondition($player) === false) {
      if (!is_null($this->getArg('oppositeEffect')) && $this->getArg('oppositeEffect') != 'OPPOSITE') {
        $node = $this->getArg('oppositeEffect');
      } else {
        $this->resolveAction(['notMet']);
        return;
      }
    }

    $cardId = $this->getCtxArgs()['cardId'] ?? null;
    if (!is_null($cardId)) {
      foreach ($node['childs'] ?? [] as &$eChild) {
        if (!isset($eChild['args']['cardId'])  || $eChild['args']['cardId'] != ME) {
          $eChild['args']['cardId'] = $cardId;
        }
      }
    }

    if (isset($node['childs'])) {
      foreach ($node['childs'] as &$child) {
        $child['sourceId'] = $this->getSourceId();
      }
    }
    $node['sourceId'] = $this->getSourceId();
    $this->pushParallelChild($node);
    $this->resolveAction(['met']);
  }
}
