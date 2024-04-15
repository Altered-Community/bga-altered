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
      case 'has4BoostOrLess':
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
      if (
        isset($block[CHECK_CONDITION]) &&
        isset($block[CHECK_CONDITION][$effect])
      ) {
        return false;
      }
    }
  }

  protected $args = ['condition' => null];

  public function isDoable($player)
  {
    $condition = $this->getCtxArg('condition');
    if ($condition == 'isFirstPlayer') {
      return $player->getId() == Globals::getFirstPlayer();
    } elseif ($condition == 'has5CounterOnCard') {
      return Conditions::has5CounterOnCard($player->getHero(), ['pId' => $player->getId()]);
    } else {
      return true;
    }
  }

  public function stCheckCondition()
  {
    $player = Players::getActive();
    if ($this->getCtxArg('condition') === null) {
      throw new \feException('No condition defined. Should not happen');
    }

    $source = $this->getSource();
    $condition = $this->getCtxArg('condition');
    if (Conditions::$condition($source, ['pId' => $player->getId()]) === false) {
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
