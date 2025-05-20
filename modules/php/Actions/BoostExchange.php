<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;

class BoostExchange extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_BOOST_EXCHANGE;
  }

  public function getDescription()
  {
    return clienttranslate('Exchange boosts between 2 cards');
  }

  public function isAutomatic($player = null)
  {
    return true;
  }

  public function isIndependent($player = null)
  {
    return true;
  }

  public function getPlayer()
  {
    $pId = $this->getCtxArg('pId') ?? Players::getActiveId();
    return Players::get($pId);
  }

  protected $args = [
    'cardId' => null
  ];

  public function stBoostExchange()
  {
    $player = $this->getPlayer();
    $allIds = $this->getArg('cardId');
    if (is_null($allIds) || count($allIds) != 2) {
      throw new \BgaVisibleSystemException('No Ids to switch in boostExchange, should not happen');
    }

    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }
    $card1 = $allIds[0];
    $card2 = $allIds[1];


    $allCards = Cards::get($allIds);
    $existingBoost = [];
    $existingBoost[$card2] = $allCards[$card1]->countToken(BOOST);
    $existingBoost[$card1] = $allCards[$card2]->countToken(BOOST);

    $meeplesCard1 = $allCards[$card1]->getOfType(BOOST);
    $meeplesCard2 = $allCards[$card2]->getOfType(BOOST);

    if ($meeplesCard1->count() > 0) {
      Meeples::delete($meeplesCard1->getIds());
      Notifications::looseMeeples(BOOST, $allCards[$card1], $meeplesCard1, false);
    }
    if ($existingBoost[$card2] > 0) {
      $tokens = Meeples::createOnCard(BOOST, $allCards[$card2]->getId(), $allCards[$card2]->getPlayer()->getId(), $existingBoost[$card2]);
      Notifications::gainMeeple(BOOST, $allCards[$card2], $tokens, $source, false);
    }

    if ($meeplesCard2->count() > 0) {
      Meeples::delete($meeplesCard2->getIds());
      Notifications::looseMeeples(BOOST, $allCards[$card2], $meeplesCard2, false);
    }
    if ($existingBoost[$card1] > 0) {
      $tokens = Meeples::createOnCard(BOOST, $allCards[$card1]->getId(), $allCards[$card1]->getPlayer()->getId(), $existingBoost[$card1]);
      Notifications::gainMeeple(BOOST, $allCards[$card1], $tokens, $source, false);
    }


    $this->resolveAction();
  }
}
