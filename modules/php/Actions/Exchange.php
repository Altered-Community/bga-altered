<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Managers\ActionCards;
use ALT\Core\Engine;
use ALT\Core\Globals;
use ALT\Core\Stats;
use ALT\Helpers\Collection;
use ALT\Helpers\Utils;
use ALT\Models\Player;
use ALT\Helpers\FT;

class Exchange extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_EXCHANGE;
  }

  protected $args = [
    'upTo' => false, // if n > 1, can the player select UP TO n cards or exactly n cards ?
    'targetPlayer' => ME,
    'targetType' => [CHARACTER, TOKEN], // must be an array
    'maxReserveCost' => INFTY, // limitation
    'maxHandCost' => INFTY, // limitation
    'minReserveCost' => 0, // limitation
    'minHandCost' => 0, // limitation
    'n' => 1, // number of targets
    'statuses' => 'disabled', // does it has those statuses
    'excludeSelf' => false,
    'totalCost' => INFTY,
    'totalMountain' => INFTY,
    'hasEffects' => 'disabled',
    'cards' => [],
    'discardRemaining' => false,
    'subType' => 'disabled',
    'expeditionAttributes' => null,
    'excludeBiomes' => false,
    'isTapped' => false,
    'maxStatistic' => 99,
  ];

  public function getDescription()
  {
    $targetType = $this->getArg('targetType');
    $msg = '';
    if (count($targetType) == 1 && $targetType == [CHARACTER]) {
      $msg = clienttranslate('Exchange Character in your Reserve with a card from your Hand');
    } else {
      $msg = clienttranslate('Exchange card in your Reserve with a card from your Hand');
    }

    return [
      'log' => $msg,
      'args' => [
        'n' => $this->getCtxArg('n') ?? 1,
      ],
    ];
  }

  public function isDoable($player)
  {
    return $this->getArg('upTo') || count($this->getTargetableCards($player)[0]) != 0;
  }

  public function getTargetableCards($player, $checkTough = false)
  {
    // Who is the target ?
    $pId = $player->getId();
    $pIds = Players::getAll()->getIds();
    $targetPlayer = $this->getArg('targetPlayer');
    if ($targetPlayer == ME) {
      $pIds = [$pId];
    }
    if ($targetPlayer == OPPONENT) {
      $pIds = array_diff($pIds, [$pId]);
    }

    // What cards ?
    $targetType = $this->getArg('targetType');

    $reserveCards = Cards::getFiltered($pIds, RESERVE, $targetType);
    $handCards = Cards::getFiltered($pIds, HAND);

    return [$reserveCards, $handCards];
  }

  public function argsExchange()
  {
    $player = Players::getActive();
    list($reserve, $hand) = $this->getTargetableCards($player);

    return [
      'n' => $this->getArg('n'),
      'reserveIds' => $reserve->getIds(),
      'handIds' => $hand->getIds(),
    ];
  }

  public function actExchange($reserveId, $handId)
  {
    $player = Players::getActive();
    $args = $this->argsExchange();

    if (!in_array($reserveId, $args['reserveIds'])) {
      throw new \BgaVisibleSystemException('You cannot target this card. Should not happen');
    }
    if (!in_array($handId, $args['handIds'])) {
      throw new \BgaVisibleSystemException('You cannot target this card. Should not happen');
    }
    $hand = Cards::get($handId);
    $reserve = Cards::get($reserveId);

    $this->insertAsChild(['type' => NODE_SEQ, 'childs' => [
      FT::ACTION(DISCARD, ['destination' => HAND, 'cardId' => $reserveId]),
      FT::ACTION(DISCARD, ['destination' => RESERVE, 'cardId' => $handId])
    ]]);

    return 'exchange';
  }
}
