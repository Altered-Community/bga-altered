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

  public function getDescription()
  {
    switch ($this->getArg('condition')) {
      case 'hasBoost:4:LTE':
        return clienttranslate('Check if there are less than 4 <BOOST>');
        break;
      default:
        '';
    }
    return '';
  }

  public function isIndependent($player = null)
  {
    $cards = Cards::getPlayedCards(null);
    $effect = $this->getArg('condition');
    foreach ($cards as $cId => $card) {
      $block = $card->getBlockAutomaticAction();
      if (isset($block[CHECK_CONDITION]) && isset($block[CHECK_CONDITION][$effect])) {
        return false;
      }
    }
  }

  protected $args = ['condition' => null];

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
    if ($this->getCtxArg('condition') === null) {
      throw new \feException('No condition defined. Should not happen');
    }

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
