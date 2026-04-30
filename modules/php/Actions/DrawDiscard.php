<?php

namespace ALT\Actions;

use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Helpers\FT;
use ALT\Models\Player;

class DrawDiscard extends \ALT\Models\Action
{
  public function getState(): int
  {
    return ST_DRAW_DISCARD;
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

  public function isAutomatic($player = null): bool
  {
    return true;
  }

  public function isIrreversible($player = null): bool
  {
    return true;
  }

  public function getPlayer(): mixed
  {
    $pId = $this->getCtxArg('pId') ?? Players::getActiveId();
    return Players::get($pId);
  }

  protected $args = [
    'n' => 1,
    'location' => DISCARD_PILE,
    'cardId' => null,
  ];

  public function stDrawDiscard(): void
  {
    $n = $this->getArg('n');
    $player = $this->getPlayer();

    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }

    // $cards = Cards::pickForLocation($n, 'deck-' . $player->getId(), DISCARD_PILE);

    $cards = $player->draw(
      $n,
      'deck-' . $player->getId(),
      LIMBO,
      $source,
      clienttranslate(
        '${player_name} draws ${card_names} from its deck and discard it'
      ),
      clienttranslate(
        'You draw ${card_names} from your deck and discard it'
      )
    );
    $this->insertAsChild(
      FT::ACTION(
        TARGET,
        [
          'effect' => FT::ACTION(DISCARD, []),
          'targetType' => [CHARACTER, TOKEN, SPELL, PERMANENT],
          'targetLocation' => [LIMBO],
          'targetPlayer' => ME,
          'cards' => $cards->getIds(),
        ],
        [
          'sourceId' => $sourceId,
          'pId' => $player->getId()
        ]
      )
    );

    // Notifications::discardCards(
    //   $player, 
    //   $cards, 
    //   null, 
    //   clienttranslate('${player_name} draws ${n} card(s) and discard them'), 
    //   ['fromLocation' => 'deck']
    // );

    $this->resolveAction(null, false);
  }
}
