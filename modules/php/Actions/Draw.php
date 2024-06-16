<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Core\Engine;

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
    $location = $this->getArg('location');

    if ($players == ALL) {
      if ($location == MANA) {
        return [
          'log' => clienttranslate('All players puts the top deck card in their mana one'),
          'args' => [
            'n' => $n,
          ],
        ];
      } else {
        return [
          'log' => clienttranslate('All players draw ${n} card(s)'),
          'args' => [
            'n' => $n,
          ],
        ];
      }
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

  public function isIrreversible($player = null)
  {
    return true;
  }

  protected $args = [
    'n' => 1,
    'players' => ALL,
    'location' => HAND,
    'tapped' => false,
  ];

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
      $players = [Players::getNext(Players::getActive())];
    }

    foreach ($players as $player) {
      if ($this->getArg('location') == MANA) {
        $cards = $player->draw(
          1,
          null,
          MANA,
          $player->getHero(),
          clienttranslate('${player_name} draws 1 card from its deck and put it in mana (${card_name2}\'s effect)'),
          clienttranslate('You draw ${card_names} from your deck and put it in mana (${card_name2}\'s effect)'),
          $this->getArg('tapped')
        );
      } else {
        $player->draw($n, null, null, $source);
      }
      $this->checkAfterListeners($player, ['draw' => $n]);
    }

    $this->resolveAction(null, true);
  }
}
