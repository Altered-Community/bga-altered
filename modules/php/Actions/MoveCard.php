<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Core\Engine;

class MoveCard extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_MOVE_CARD;
  }

  public function getDescription()
  {
    if (($this->getCtxArg('cardId') ?? null) == null) {
      return clienttranslate('move a character to opposite expedition');
    }

    return [
      'log' => clienttranslate('move ${card_name} to opposite expedition'),
      'args' => ['card_name' => $this->getCard()->getName(), 'i18n' => ['card_name']],
    ];
    return clienttranslate('Move expedition');
  }

  public function isAutomatic($player = null)
  {
    return true;
  }

  protected $args = ['location' => 'opposite'];

  public function getCard()
  {
    $args = $this->getCtxArgs();
    $cardId = $args['cardId'] ?? null;
    if ($cardId === null) {
      throw new \BgaVisibleSystemException('no card in args. Should not happen');
    }
    return Cards::get($cardId);
  }

  public function stMoveCard()
  {
    $card = $this->getCard();
    $source = $this->getSource();

    $map = [STORM_LEFT => STORM_RIGHT, STORM_RIGHT => STORM_LEFT];
    if ($this->getArg('location') == 'opposite') {
      $card->setLocation($map[$card->getLocation()]);
    }

    Notifications::moveCard($source->getPlayer(), $card, $source);
    Notifications::updateBiomes($card->getPlayer());
    $this->resolveAction(null);
  }
}
