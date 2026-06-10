<?php

namespace ALT\Actions;

use ALT\Managers\Cards;
use ALT\Core\Notifications;

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
    if ($cardId == ME || is_null($cardId)) {
      $cardId = $this->resolveSourceId();
    } elseif ($cardId == EFFECT) {
      $event = $this->getEventRecursive();
      $cardId = $event['cardId'] ?? null;
    }

    if (is_null($cardId)) {
      throw new \BgaVisibleSystemException('no card in args (Exhaust). Should not happen');
    }
    return Cards::getSingle($cardId);
  }

  public function stExhaust()
  {
    $player = $this->getPlayer();
    $card = $this->getCard();
    // if the card was a token or has been discarded / put to hand
    if (is_null($card) || !in_array($card->getLocation(), [STORM_LEFT, STORM_RIGHT, LANDMARK, RESERVE])) {
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
      'token' => $card->isToken(),
    ]);

    $this->resolveAction();
  }
}
