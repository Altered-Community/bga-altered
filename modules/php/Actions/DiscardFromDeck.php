<?php

namespace ALT\Actions;

use ALT\Helpers\Collection;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Models\Action;

/**
 * This action discards N card from the deck of the chosen player or both.
 * The args of this action are:
 * - "players", possible values are:  ME (means current player), OPPONENT, ALL
 * - "n" is the number of cards discarded
 */
class DiscardFromDeck extends Action
{
    public function getState(): int
    {
        return ST_DISCARD_FROM_DECK;
    }

    public function getDescription(): array
    {
        return [
            'log' => clienttranslate('Discard ${n} from deck'),
            'args' => [
                'n' => $this->getArg('n'),
            ],
        ];
    }

    public function isAutomatic(mixed $player = null): bool
    {
        return false;
    }

    public function isIrreversible(mixed $player = null): bool
    {
        return true;
    }

    public function getPlayer(): array|Collection
    {
        $targetPlayers = $this->getCtxArg('players') ?? $this->getArg('players');
        $currentPlayer = Players::getActive();
        $target = [];

        if ($targetPlayers == ME) {
            $target = [$currentPlayer];
        } elseif ($targetPlayers == OPPONENT) {
            $target = [Players::getNext($currentPlayer)];
        } elseif ($targetPlayers == ALL) {
            $target = Players::getAll();
        }
        return $target;
    }

    protected $args = [
        'players' => ME,
        'n' => 1,
    ];

    public function stDiscardFromDeck(): void
    {
        $n = $this->getArg('n');
        $players = $this->getPlayer();

        $source = $this->ctx->getSource() ?? null;
        $sourceId = $this->ctx->getSourceId() ?? null;
        if (is_null($source) && !is_null($sourceId)) {
            $source = Cards::getSingle($sourceId);
        }

        foreach ($players as $player) {
            $player->draw(
                $n,
                'deck-' . $player->getId(),
                DISCARD_PILE,
                $source,
                clienttranslate(
                    '${player_name} discard ${card_names} from its deck'
                ),
                clienttranslate(
                    'You discard ${card_names} from your deck'
                )
            );
        }

        $this->resolveAction(null, true);
    }
}
