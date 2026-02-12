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
    if (isset($this->ctx->getInfos()['automatic'])) {
      return $this->ctx->getInfos()['automatic'];
    }
    return !$this->isOptional($player);
  }

  public function isIrreversible($player = null)
  {
    return true;
  }

  protected $args = [
    'n' => 1,
    'exhausted' => false,
    'character2Less' => false,
    'characterHand' => false,
    'ownerId' => null,
    'player' => null
  ];

  public function getPlayer()
  {
    $pId = $this->ctx->getPId();
    // throw new \feException($pId);

    // throw new \feException()
    if ($this->getArg('player') == 'owner' || $pId == 'owner') {
      $pId = $this->getArg('ownerId');
    } elseif ($pId == 'active') {
      $pId = Players::getActiveId();
    } elseif ($this->getArg('player') == 'nextPlayer') {
      $pId = Players::getNextId(Players::getActive());
    } elseif (is_null($pId)) {
      $pId = ($this->getSource() == null ? Players::getActiveId() : $this->getSource()->getPId());
    } elseif (isset($this->getEventRecursive()['pId']) && ($this->getEventRecursive()['cardId'] ?? -1) == $this->getSourceId()) {
      $pId = $this->getEventRecursive()['pId'];
    }

    return Players::get($pId);
  }

  public function stResupply()
  {
    $n = $this->getArg('n');
    $player = $this->getPlayer();
    $notResupply = false;
    $exhausted = $this->getArg('exhausted');
    $checkpoint = true;

    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }
    $node = [];

    // manage of AX_Rare_TheOuroborosLyraBastion
    if ($player->getResupply2()) {
      Engine::checkpoint();
      $notResupply = true;
      // draw 2, 1 goes to reserve, the other one is discarded
      $drawn = $player->draw(
        2,
        'deck-' . $player->getId(),
        LIMBO,
        $source,
        clienttranslate(
          '${player_name} draws ${card_names} from its deck and must keep 1 (${card_name2}\'s effect combined with  The Ouroboros, Lyra Bastion)'
        ),
        clienttranslate(
          'You draw ${card_names} from your deck and must keep 1 (${card_name2}\'s effect combined with The Ouroboros, Lyra Bastion)'
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
            [
              'sourceId' => $sourceId,
              'pId' => $player->getId()
            ]
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
            [
              'sourceId' => $sourceId,
              'pId' => $player->getId()
            ]
          )
        )
      );
      $cards = $drawn;
      $checkpoint = false;
    } else {
      $cards = $player->draw(
        $n,
        'deck-' . $player->getId(),
        RESERVE,
        $source,
        $exhausted ? clienttranslate('${player_name} places ${card_names} from its deck to Reserve as exhausted(${card_name2}\'s effect)') : clienttranslate('${player_name} places ${card_names} from its deck to Reserve (${card_name2}\'s effect)'),
        $exhausted ? clienttranslate('You put ${card_names} from your deck in Reserve as exhausted (${card_name2}\'s effect)') : clienttranslate('You put ${card_names} from your deck in Reserve (${card_name2}\'s effect)'),
        $exhausted,
        $player->getId()
      );
      if ($this->getArg('character2Less')) {
        foreach ($cards as $cId => $card) {
          if ($card->getType() == CHARACTER) {
            $node[] = FT::SEQ_OPTIONAL(
              [
                'action' => SPECIAL_EFFECT,
                'args' => [
                  'effect' => 'costReduction',
                  'args' => ['type' => ALL, 'reduction' => 2],
                ],
                'sourceId' => $sourceId,
                'pId' => $player->getId()
              ],
              FT::ACTION(
                PLAY_CARD,
                [
                  'cardId' => $card->getId(),
                ],
                ['sourceId' => $sourceId, 'pId' => $player->getId()]
              )
            );
          }
          foreach ($node as &$n) {
            $n['pId'] = $player->getId();
          }
        }
      }
      if ($this->getArg('characterHand')) {
        foreach ($cards as $cId => $card) {
          if ($card->getType() == CHARACTER) {
            $node[] = FT::ACTION(DISCARD, ['cardId' => $cId, 'destination' => HAND], ['optional' => true, 'pId' => $player->getId()]);
          }
        }
      }
    }
    // Machine in the ice effect
    foreach ($cards as $cId => $card) {
      if ($card->isResupplyExhaust()) {
        $node[] = FT::ACTION(
          EXHAUST,
          [
            'cardId' => $cId
          ],
          ['sourceId' => $cId]
        );
      }
    }
    if (!empty($node)) {
      $this->pushAfterFinishingChilds($node);
    }
    if ($cards->count() > 0) {
      $this->checkAfterListeners($player, ['draw' => $n, 'sourceId' => $this->getSourceId(), 'notResupply' => $notResupply, 'exhausted' => $exhausted]);
    }

    $this->resolveAction(null, $checkpoint);
  }
}
