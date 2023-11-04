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
    return '';
  }

  protected $args = ['condition' => null];

  public function stCheckCondition()
  {
    $player = Players::getActive();
    if ($this->getCtxArg('condition') === null) {
      throw new \feException('No condition defined. Should not happen');
    }

    $source = $this->getSource();
    $condition = $this->getCtxArg('condition');
    if (Conditions::$condition($source, []) === false) {
      $this->resolveAction(['notMet']);
      return;
    }

    $node = $this->getArg('effect');
    $node['sourceId'] = $this->getSourceId();
    $this->pushParallelChild($node);
  }
}
