<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Globals;
use ALT\Core\Stats;
use ALT\Helpers\Utils;

class Tap extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_TAP;
  }

  public function getDescription()
  {
    $description = $this->getCtxArg('description');
    if (!is_null($description)) {
      return $description;
    }
    return clienttranslate('Exhaust this card ({T})');
  }

  public function isDoable($player)
  {
    return $this->getCard()->isTapped() == false && $player->getMana() >= ($this->getCtxArg('pay') ?? 0);
  }

  public function getCard()
  {
    $args = $this->getCtxArgs();
    $cardId = $args['cardId'] ?? $this->getSourceId();
    if ($cardId == ME) {
      $cardId = $this->ctx->getSourceId() ?? null;
    }
    if ($cardId === null) {
      throw new \BgaVisibleSystemException('no card in args (tap). Should not happen');
    }
    return Cards::get($cardId);
  }

  public function stTap()
  {
    $player = $this->getPlayer();
    $card = $this->getCard();

    $pay = $this->getCtxArg('pay') ?? 0;
    if ($pay > 0) {
      $player->payMana($pay);
    }

    if ($card->isTapped()) {
      throw new \BgaVisibleSystemException('Card is already tapped. Should not happen');
    }
    $card->setTapped(true);
    Notifications::tapEffect($player, $card, $pay);
    $abilityActivated = Globals::getAbilityActivatedThisTurn();
    $abilityActivated[$player->getId()] = array_merge(
      $abilityActivated[$player->getId()] ?? [],
      ['tap' => true]
    );
    Globals::setAbilityActivatedThisTurn($abilityActivated);
    $abilityActivatedCount = Globals::getAbilityActivatedThisTurnCount();
    $abilityActivatedCount[$player->getId()] = ($abilityActivatedCount[$player->getId()] ?? 0) + 1;
    Globals::setAbilityActivatedThisTurnCount($abilityActivatedCount);
    $abilityActivatedTypeCount = Globals::getAbilityActivatedThisTurnTypeCount();
    $abilityActivatedTypeCount[$player->getId()] = $abilityActivatedTypeCount[$player->getId()] ?? [];
    $abilityActivatedTypeCount[$player->getId()]['tap'] = ($abilityActivatedTypeCount[$player->getId()]['tap'] ?? 0) + 1;
    Globals::setAbilityActivatedThisTurnTypeCount($abilityActivatedTypeCount);
    // Check listener
    $this->checkAfterListeners($player, [
      'cardId' => $card->getId(),
      'cardLocation' => $card->getLocation(),
      'sourceId' => $this->getSourceId(),
      'token' => $card->isToken(),
    ], true, 'Exhaust');

    $this->resolveAction();
  }
}
