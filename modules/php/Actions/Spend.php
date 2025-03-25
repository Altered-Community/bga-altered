<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Core\Globals;
use ALT\Helpers\Log;
use ALT\Core\Engine;
use ALT\Helpers\FT;
use ALT\Helpers\Collection;

class Spend extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_SPEND;
  }

  public function getDescription()
  {
    $n = $this->getCtxArg('n') ?? 1;

    return [
      'log' => clienttranslate('Spend ${n} to ${effect_desc}'),
      'args' => [
        'n' => $n,
        'effect_desc' => Engine::buildTree($this->getCtxArg('effect'))->getDescription(),
        'i18n' => ['effect_desc'],

      ],
    ];
  }

  public function isAutomatic($player = null)
  {
    return true;
  }


  protected $args = [
    'n' => 1,
    'effect' => [],
  ];

  public function getSource()
  {
    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }
    return $source;
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
      throw new \BgaVisibleSystemException('no card in args (Spend). Should not happen');
    }
    return Cards::getSingle($cardId);
  }


  public function argsSpend()
  {
    return [
      'source' => $this->getSource(),
    ];
  }

  public function stSpend()
  {
    $player = Players::getActive();
    $source = $this->getSource();
    $card = $this->getCard();
    $amount = $this->getArg('n');
    if ($card->countToken(BOOST) > 0) {
      $deleted = new Collection();
      $meeples = $card->getOfType(BOOST);

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
          Notifications::spend(BOOST, $card, $deleted, false);
        }
      }
    } else {
      // we consume a counter
      $extraDatas = $card->getExtraDatas();
      if (!isset($extraDatas['counter']) || $extraDatas['counter'] == 0) {
        throw new \BgaVisibleSystemException('No counter on card. Cannot spend. Should not happen');
      }

      if (($extraDatas['counter'] ?? 0) < $amount) {
        throw new \BgaVisibleSystemException('Cannot consume counter. Should not happen');
      }

      $extraDatas['counter'] -= $amount;
      $card->setExtraDatas($extraDatas);

      Notifications::spendCounter($player, $card, $amount, $this->getSource());
    }

    $effect = $this->getArg('effect');
    if ($effect !== null) {
      $this->updateCardId($effect, $card->getId(), $card->getLocation(), $this->getSourceId(), $card->getPlayer()->getId());
      $this->insertAsChild($effect);
    }
    $this->resolveAction();
  }
}
