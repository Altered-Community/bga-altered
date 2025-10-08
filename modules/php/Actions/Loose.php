<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Collection;
use ALT\Helpers\Utils;
use ALT\Helpers\FT;

class Loose extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_LOOSE;
  }

  public function getDescription()
  {
    $player = $this->getPlayer();
    $gain = $this->getLoose();
    $desc = Utils::resourcesToStr([$gain[0] => $gain[1]], true);

    if ($player->getId() == Players::getActiveId()) {
      return [
        'log' => clienttranslate('loose ${resources_desc}'),
        'args' => [
          'resources_desc' => $desc,
        ],
      ];
    }
    // The reward is for someone else
    else {
      return [
        'log' => clienttranslate('Let ${player_name} loose ${resources_desc}'),
        'args' => [
          'player_name' => $player->getName(),
          'resources_desc' => $desc,
        ],
      ];
    }
  }

  public function isAutomatic($player = null)
  {
    return $this->getArg('upTo') == false;
  }

  public function isIndependent($player = null)
  {
    $cards = Cards::getPlayedCards(null);
    $gain = $this->getArg('type');
    foreach ($cards as $cId => $card) {
      $block = $card->getBlockAutomaticAction();
      if (isset($block[LOOSE]) && isset($block[LOOSE][$gain])) {
        return false;
      }
    }
    return $this->getArg('upTo') == false;
  }

  public function getPlayer()
  {
    $args = $this->getCtxArgs();
    $pId = $args['pId'] ?? Players::getActiveId();
    return Players::get($pId);
  }

  public function getCard()
  {
    $cardId = $this->getCtxArg('cardId');
    if ($cardId == ME) {
      $cardId = $this->ctx->getSourceId() ?? null;
    }

    if (is_null($cardId)) {
      throw new \BgaVisibleSystemException('no card in args (Loose). Should not happen');
    }
    return Cards::getSingle($cardId);
  }

  protected $args = [
    'n' => 1,
    'upTo' => false
  ];

  public function getLoose()
  {
    return [$this->getArg('type'), $this->getArg('n')];
  }

  // public function isDoable($player)
  // {
  //   return $this->getCard()->hasToken($this->getArg('type'));
  // }

  public function stLoose()
  {
    $player = $this->getPlayer();
    $args = $this->getCtxArgs();
    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }
    $card = $this->getCard();
    $deleted = new Collection();

    // Increase resource and notify
    list($resource, $amount) = $this->getLoose();

    // Loose one counter
    if ($resource == 'counter') {
      if ($card->countToken(BOOST) > 0) {
        $resource = BOOST;
      } else {
        // we need to remove counter
        $this->insertAsChild(FT::ACTION(USE_COUNTER, ['cardId' => $card->getId(), 'consume' => $amount, 'upTo' => $this->getArg('upTo')], ['sourceId' => $card->getId()]));
        $this->resolveAction();
        return;
      }
    }

    $meeples = $card->getOfType($resource);

    foreach ($meeples as $mId => $m) {
      if ($amount == 0) {
        break;
      }
      $deleted[$mId] = $m;
      $amount--;
    }
    if (!empty($deleted)) {
      Meeples::delete($deleted->getIds());

      if (count($deleted) > 0) {
        Notifications::looseMeeples($resource, $card, $deleted, false);
      }

      $this->checkAfterListeners($player, ['loose' => $args, 'token' => $card->isToken(),]);
    }
    $this->resolveAction();
  }
}
