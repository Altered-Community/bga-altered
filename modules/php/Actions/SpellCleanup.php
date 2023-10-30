<?php
namespace ALT\Actions;
use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;

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
      throw new \BgaVisibleSystemException('no card in args. Should not happen');
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
    } else {
      // moved to reserve
      $deleted = $card->moveToMemory();
    }
    Notifications::spellCleanup($card, $deleted->getIds());

    $this->resolveAction();
  }
}
