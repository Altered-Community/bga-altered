<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;

class Exhaust extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_EXHAUST;
  }

  public function getDescription()
  {
    return '{T}';
  }

  public function isDoable($player)
  {
    return $this->getCard()->isTapped() == false;
  }

  public function getCard()
  {
    $cardId = $this->getCtxArg('cardId');
    if ($cardId == ME) {
      $cardId = $this->ctx->getSourceId() ?? null;
    } elseif ($cardId == EFFECT) {
      $cardId = $this->getCtx()->toArray()['event']['cardId'] ?? null;
    }

    if (is_null($cardId)) {
      throw new \BgaVisibleSystemException('no card in args (Gain). Should not happen');
    }
    return Cards::getSingle($cardId);
  }

  public function stExhaust()
  {
    $player = $this->getPlayer();
    $card = $this->getCard();
    // if the card was a token or has been discarded / put to hand
    if (is_null($card) || $card->getLocation() != RESERVE) {
      $this->resolveAction();
      return;
    }

    if ($card->isTapped()) {
      throw new \BgaVisibleSystemException('Card is already tapped. Should not happen');
    }
    $card->setTapped(true);

    Notifications::exhaustEffect($player, $card, $this->getSource());
    // Check listener
    $this->checkAfterListeners($player, [
      'cardId' => $card->getId(),
      'cardLocation' => $card->getLocation(),
      'sourceId' => $this->getSourceId(),
    ]);

    $this->resolveAction();
  }
}
