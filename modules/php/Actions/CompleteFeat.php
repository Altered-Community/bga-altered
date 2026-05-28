<?php

namespace ALT\Actions;

use ALT\Managers\Cards;
use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Core\Notifications;

class CompleteFeat extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_COMPLETE_FEAT;
  }

  public function getDescription()
  {
    return clienttranslate('Complete Feat');
  }

  /**
   * Action always resolved automatically in game state.
   *
   * @param mixed $player Unused for this action.
   */
  public function isAutomatic($player = null)
  {
    return true;
  }

  /**
   * Resolves the Feat card targeted by this action from context arguments.
   *
   * Supported context args (from FT::ACTION(COMPLETE_FEAT, ...)):
   * - cardId (required): target card id, or aliases:
   *   - ME / 'source': resolves to the current action source card id.
   *
   * @throws \BgaVisibleSystemException If no cardId was provided.
   */
  public function getTargetCard()
  {
    $args = $this->getCtxArgs();
    $cardId = $args['cardId'] ?? null;
    if ($cardId === ME || $cardId === 'source') {
      $cardId = $this->getSourceId();
    }
    if ($cardId === EFFECT) {
      $cardId = $this->getEvent()['cardId'] ?? $this->getSourceId();
    }
    if ($cardId === null) {
      throw new \BgaVisibleSystemException('CompleteFeat: missing cardId');
    }
    return Cards::get($cardId);
  }

  /**
   * Complete the targeted Feat by placing one FEAT_COMPLETED meeple on it.
   *
   * Idempotent behavior:
   * - if already completed, the action simply resolves with no new meeple.
   */
  public function stCompleteFeat()
  {
    $card = $this->getTargetCard();
    if (Meeples::countMeeples('card-' . $card->getId(), FEAT_COMPLETED) >= 1) {
      $this->resolveAction();
      return;
    }

    $player = Players::get($card->getPId());
    $meeple = Meeples::singleCreate([
      'type' => FEAT_COMPLETED,
      'location' => 'card-' . $card->getId(),
      'player_id' => $player->getId(),
    ]);

    Notifications::featCompleted($player, $card, $meeple);
    $this->resolveAction();
  }
}
