<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Core\Globals;

class Ready extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_READY;
  }

  public function getDescription()
  {
    if ($this->getCtxArg('cardId') == MANA) {
      return clienttranslate('Ready a mana orb');
    } else {
      return clienttranslate('Ready the card');
    }
  }

  public function isDoable($player)
  {
    return true;
    // if ($this->getCtxArg('cardId') == MANA) {
    //   if (empty($this->getSource()->getPlayer()->getManaCards(true))) {
    //     return false;
    //   }
    // }
    return $this->getCard()->isTapped() == true;
  }

  public function getCard()
  {
    $cardId = $this->getCtxArg('cardId');
    if ($cardId == ME) {
      $cardId = $this->ctx->getSourceId() ?? null;
    } elseif ($cardId == EFFECT) {
      $cardId = $this->getCtx()->toArray()['event']['cardId'] ?? null;
    } elseif ($cardId == MANA) {
      return $this->getSource()->getPlayer()->getManaCards(true)->first();
    }

    if (is_null($cardId)) {
      throw new \BgaVisibleSystemException('no card in args (Ready). Should not happen');
    }
    return Cards::getSingle($cardId);
  }

  public function stReady()
  {
    $player = $this->getPlayer();
    $card = $this->getCard();

    if (!$card->isTapped() && is_null($this->getCtxArg('optionalExhaust'))) {
      throw new \BgaVisibleSystemException('Card is not tapped. Should not happen');
    }
    $card->setTapped(false);
    Notifications::readyEffect($player, $card, $this->getSource());

    $this->resolveAction();
  }
}
