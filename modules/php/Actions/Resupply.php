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
use ALT\Models\Player;

class Resupply extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_RESUPPLY;
  }

  public function getDescription()
  {
    $player = $this->getPlayer();
    $exhausted = $this->getArg('exhausted');
    if (!$exhausted) {
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
    } else {
      // The resupply must be exhausted
      if ($player->getResupply2()) {
        return clienttranslate('Lyra Bastion\'s resupply (exhausted)');
      } else {
        return [
          'log' => clienttranslate('Exhausted resupply ${n}'),
          'args' => [
            'n' => $this->getArg('n'),
          ],
        ];
      }
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
    'exhausted' => false,
  ];

  public function getPlayer()
  {
    $pId = $this->ctx->getPId();
    if (is_null($pId)) {
      $pId = ($this->getSource() == null ? Players::getActiveId() : $this->getSource()->getPId());
    } elseif ($pId == 'active') {
      $pId = Players::getActiveId();
    }

    return Players::get($pId);
  }

  public function stResupply()
  {
    $n = $this->getArg('n');
    $player = $this->getPlayer();
    $notResupply = false;
    $exhausted = $this->getArg('exhausted');

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
      $cards= $drawn;
    } else {
      $cards = $player->draw(
        $n,
        'deck-' . $player->getId(),
        RESERVE,
        $source,
        $exhausted ? clienttranslate('You put ${card_names} from your deck in Reserve as exhausted (${card_name2}\'s effect)') : clienttranslate('You put ${card_names} from your deck in Reserve (${card_name2}\'s effect)'),
        $exhausted ? clienttranslate('${player_name} places ${card_names} from its deck to Reserve as exhausted(${card_name2}\'s effect)') : clienttranslate('${player_name} places ${card_names} from its deck to Reserve (${card_name2}\'s effect)'),
        $exhausted
      );
    }
    // Machine in the ice effect
    $node = [];
    foreach ($cards as $cId => $card){
      if ($card->isResupplyExhaust()) {
        $node[] = FT::ACTION(
          EXHAUST,
          [
              'cardId' => $cId
          ], 
          ['sourceId' => $cId]);
      }
    }
    if (!empty($node)) {
      $this->pushAfterFinishingChilds($node);
    }
    $this->checkAfterListeners($player, ['draw' => $n, 'sourceId' => $this->getSourceId(), 'notResupply' => $notResupply]);

    $this->resolveAction(null, true);
  }
}
