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

  protected $args = ['condition' => null];

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
    $desc = '';
    foreach ($conditions as $condition) {
      if ($condition == 'hasBoost:4:LTE') {
        $desc = clienttranslate('Check if there are less than 4 <BOOST>');
      }
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
    return $this->checkCondition($player);
  }

  public function checkCondition($player)
  {
    $source = $this->getSource();
    $event = ['pId' => $player->getId()];
    $card = $source ?? $player->getHero();
    return Conditions::check($this->getCtxArgs(), $card, $event);
  }

  public function stCheckCondition()
  {
    $player = Players::getActive();

    if ($this->checkCondition($player) === false) {
      $this->resolveAction(['notMet']);
      return;
    }

    $node = $this->getArg('effect');
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
