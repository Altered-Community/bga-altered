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

  public function isAutomatic($player = null)
  {
    return true;
  }

  public function getTargetCard()
  {
    $args = $this->getCtxArgs();
    $cardId = $args['cardId'] ?? null;
    if ($cardId === ME || $cardId === 'source') {
      $cardId = $this->getSourceId();
    }
    if ($cardId === null) {
      throw new \Bga\GameFramework\VisibleSystemException('CompleteFeat: missing cardId');
    }
    return Cards::get($cardId);
  }

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
