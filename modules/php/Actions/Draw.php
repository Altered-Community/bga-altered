<?php
namespace ALT\Actions;
use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;

class Draw extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_DRAW;
  }

  public function getDescription()
  {
    $n = $this->getCtxArg('n') ?? 1;
    $players = $this->getCtxArg('players') ?? ALL;

    if ($players == ALL) {
      return [
        'log' => clienttranslate('All players draw ${n} card(s)'),
        'args' => [
          'n' => $n,
        ],
      ];
    } elseif ($players == OPPONENT) {
      return [
        'log' => clienttranslate('The opponent draws ${n} card(s)'),
        'args' => [
          'n' => $n,
        ],
      ];
    }
    // The reward is for the player
    else {
      return [
        'log' => clienttranslate('Draw ${n} card(s)'),
        'args' => [
          'n' => $n,
        ],
      ];
    }
  }

  public function isAutomatic($player = null)
  {
    return true;
  }

  public function stDraw()
  {
    $n = $this->getCtxArg('n') ?? 1;
    $who = $this->getCtxArg('players') ?? ALL;

    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }

    if ($who == ME) {
      $players = [Players::getActive()];
    } elseif ($who == ALL) {
      $players = Players::getAll();
    } else {
      $players = [Players::getNext()];
    }

    foreach ($players as $player) {
      $player->draw($n);
    }

    $this->checkAfterListeners($players, ['draw' => $n]);
    $this->resolveAction();
  }
}
