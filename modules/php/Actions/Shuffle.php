<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Core\Engine;

class Shuffle extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_DRAW;
  }

  public function getDescription()
  {
    return clienttranslate('Shuffle the discard pile');
  }

  public function isAutomatic($player = null)
  {
    return false;
  }

  public function isIndependent($player = null)
  {
    return false;
  }

  public function isOptional($player)
  {
    return true;
  }

  public function isIrreversible($player = null)
  {
    return true;
  }

  protected $args = [];

  public function stShuffle()
  {
    $player = Players::getActive();
    Cards::reformDeckFromDiscard('deck-' . $player->getId());
    $this->resolveAction(null, true);
  }
}
