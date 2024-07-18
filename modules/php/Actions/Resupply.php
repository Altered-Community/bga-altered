<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Core\Engine;
use ALT\Helpers\FT;

class Resupply extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_RESUPPLY;
  }

  public function getDescription()
  {
    $player = $this->getPlayer();
    if ($player->getResupply2()) {
      return clienttranslate('Lyra Bastion\'s resupply');
    } else {
      return [
        'log' => clienttranslate('Resupply ${n}'),
        'args' => [
          'n' => $this->getArg('n'),
        ],
      ];
    }
  }

  public function isAutomatic($player = null)
  {
    return !$this->isOptional($player);
  }

  public function isIrreversible($player = null)
  {
    return true;
  }

  protected $args = [
    'n' => 1,
  ];

  public function stResupply()
  {
    $n = $this->getArg('n');
    $player = $this->getPlayer();
    $notResupply = false;

    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }

    // manage of AX_Rare_TheOuroborosLyraBastion
    if ($player->getResupply2()) {
      $notResupply = true;
      // draw 2, 1 goes to reserve, the other one is discarded
      $drawn = $player->draw(
        2,
        'deck-' . $player->getId(),
        LIMBO,
        $source,
        clienttranslate(
          'You draw ${card_names} from your deck and must keep 1 (${card_name2}\'s effect combined with The Ouroboros, Lyra Bastion)'
        ),
        clienttranslate(
          '${player_name} draws ${card_names} from its deck and must keep 1 (${card_name2}\'s effect combined with  The Ouroboros, Lyra Bastion)'
        )
      );
      $this->insertAsChild(
        FT::SEQ(
          FT::ACTION(
            TARGET,
            [
              'effect' => FT::ACTION(DISCARD, []),
              'targetType' => [CHARACTER, TOKEN, SPELL, PERMANENT],
              'targetLocation' => [LIMBO],
              'targetPlayer' => ME,
              'cards' => $drawn->getIds(),
            ],
            ['sourceId' => $sourceId]
          ),
          FT::ACTION(
            TARGET,
            [
              'effect' => FT::ACTION(DISCARD, ['destination' => RESERVE]),
              'targetType' => [CHARACTER, TOKEN, SPELL, PERMANENT],
              'targetLocation' => [LIMBO],
              'targetPlayer' => ME,
              'cards' => $drawn->getIds(),
            ],
            ['sourceId' => $sourceId]
          )
        )
      );
    } else {
      $player->draw(
        $n,
        'deck-' . $player->getId(),
        RESERVE,
        $source,
        clienttranslate('You put ${card_names} from your deck in Reserve (${card_name2}\'s effect)'),
        clienttranslate('${player_name} places ${card_names} from its deck to Reserve (${card_name2}\'s effect)')
      );
    }
    $this->checkAfterListeners($player, ['draw' => $n, 'notResupply' => $notResupply]);

    $this->resolveAction(null, true);
  }
}
