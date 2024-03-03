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
use ALT\Helpers\Collection;
use ALT\Helpers\Utils;
use ALT\Models\Player;

class TargetPlayer extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_TARGET_PLAYER;
  }

  protected $args = [
    'opponentsOnly' => true,
  ];

  public function getDescription()
  {

    $msg = clienttranslate('Target player to ${effect_desc}');

    return [
      'log' => $msg,
      'args' => [
        'n' => $this->getCtxArg('n') ?? 1,
        'effect_desc' => Engine::buildTree($this->getCtxArg('effect'))->getDescription(),
        'i18n' => ['effect_desc'],
      ],
    ];
  }

  public function argsTargetPlayer()
  {
    $player = Players::getActive();

    return [
      'opponentsOnly' => $this->getArg('opponentsOnly'),
      'description' => $this->getDescription()
    ];
  }

  public function stTargetPlayer()
  {
    if ($this->getArg('opponentsOnly') == true && Players::getAll()->count() == 2) {
      return [Players::getNextId(Players::getActive())];
    }
  }


  public function actTargetPlayer($pId)
  {
    $player = Players::getActive();
    $opponentsOnly = $this->getArg('opponentsOnly');

    if ($opponentsOnly == true && $pId == $player->getId()) {
      throw new \BgaVisibleSystemException('You cannot target yourself. Should not happen');
    }

    $node = $this->getArg('effect');
    $node['sourceId'] = $this->getSourceId();
    if (isset($node['childs'])) {
      foreach ($node['childs'] as &$child) {
        $child['sourceId'] = $this->getSourceId();
      }
    }
    $node['pId'] = $pId;

    $this->insertAsChild($node);
    Notifications::message(clienttranslate('${player_name} targets ${player_name2} for ${card_name}\'s effect'), ['player' => $player, 'player2' => Players::get($pId), 'card' => $this->getSource()]);

    return [$pId];
  }
}
