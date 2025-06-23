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

class SpellCleanup extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_SPELL_CLEANUP;
  }

  public function getDescription()
  {
    return clienttranslate('Spell cleanup');
  }

  public function isAutomatic($player = null)
  {
    return true;
  }

  public function isIndependent($player = null)
  {
    return true;
  }

  public function getCard()
  {
    $args = $this->getCtxArgs();
    $cardId = $args['cardId'] ?? null;
    if ($cardId === null) {
      throw new \BgaVisibleSystemException('no card in args (spell clenaup). Should not happen');
    }
    return Cards::get($cardId);
  }

  public function stSpellCleanup()
  {
    $player = $this->getPlayer();
    $card = $this->getCard();

    if ($card->getLocation() != LIMBO) {
      $this->resolveAction();
      return;
    }
    // Card must be discarded
    if ($card->hasToken(FLEETING)) {
      $deleted = $card->discard();
      $this->checkAfterListeners($player, [
        'discardCard' => true,
        'cardId' => $card->getId(),
        'token' => $card->getType() == TOKEN,
        'from' => LIMBO,
        'to' => DISCARD_PILE,
        'sourceId' => $card->getId(),
      ], true, 'Discard');
    } else {
      // moved to reserve
      $deleted = $card->moveToReserve();
      if ($card->isCooldown()) {
        // If the card should be cooldown, we need to trigger the exhaust effect
        Engine::insertAsChild(FT::ACTION(EXHAUST, ['cardId' => $card->getId()], ['pId' => $player->getId(), 'sourceId' => $card->getId()]));
        // $card->setTapped(true);
      }
    }

    Notifications::spellCleanup($card, $deleted);

    $this->checkImmediateListeners($player, $this->getCtxArgs()['event'], true, 'ChooseAssignment');

    $this->checkAfterListeners($player, $this->getCtxArgs()['event'], true, 'ChooseAssignment');

    $this->resolveAction();
  }
}
