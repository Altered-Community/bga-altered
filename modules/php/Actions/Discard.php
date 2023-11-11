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
use ALT\Helpers\Utils;
use ALT\Models\Player;

class Discard extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_DISCARD;
  }

  public function getDescription()
  {
    $location = $this->getCtxArg('destination') ?? 'discard';
    $msg = clienttranslate('discard to ${location}');
    if ($location == 'discard') {
      $msg = clienttranslate('discard');
    }
    return [
      'log' => $msg,
      'args' => ['location' => $this->getCtxArg('destination') ?? 'discard'],
    ];
  }

  public function stDiscard()
  {
    if (!is_null($this->getCtxArg('cardId') ?? null)) {
      $this->actDiscard([$this->getCtxArg('cardId')], true);
    }
    if (!is_null($this->getCtxArg('n') ?? null) && $this->getCtxArg('n') == ME) {
      $this->actDiscard([$this->getCtx()->getSourceId()], true);
    }
  }

  public function argsDiscard()
  {
    $player = Players::getActive();
    if (!is_null($this->getCtxArg('cardId'))) {
      $cards = [];
    } elseif ($this->getCtxArg('source') == HAND) {
      $cards = $player->getHand()->getIds();
    } elseif ($this->getCtxArg('source') == RESERVE) {
      $cards = $player->getReserveCards()->getIds();
    } else {
      $cards = $player->getPlayedCards()->getIds();
    }
    return [
      'n' => $this->getCtxArg('n') ?? 1,
      'source' => $this->getCtxArg('source') ?? '',
      'destination' => $this->getCtxArg('destination') ?? 'discard',
      '_private' => [
        'active' => [
          'cards' => $cards,
        ],
      ],
    ];
  }

  public function actDiscard($cardIds, $automatic = false)
  {
    $player = Players::getActive();
    $args = $this->argsDiscard();

    if ($automatic === false) {
      // self::checkAction('actDiscard');

      if (count($cardIds) != $args['n']) {
        throw new \BgaVisibleSystemException('You must select the correct number of cards. Should not happen');
      }

      if (!empty(array_diff($cardIds, $args['_private']['active']['cards']))) {
        throw new \BgaVisibleSystemException('You selected a card that should not be discarded. Should not happen');
      }
    }

    foreach ($cardIds as $cardId) {
      Cards::get($cardId)->checkLeaveExpeditionListener();
    }

    Cards::discard($cardIds, $args['destination']);
    $cards = Cards::getMany($cardIds);

    $deleted = [];
    foreach ($cardIds as $cardId) {
      $deleted = array_merge($deleted, Meeples::getInLocation('card-' . $cardId)->getIds());
      Meeples::delete(Meeples::getInLocation('card-' . $cardId)->getIds());
    }

    $msg = clienttranslate('${player_name} discards ${n} card(s) from the ${source} to ${destination}');
    if ($args['destination'] == HAND) {
      $msg = clienttranslate('${player_name} puts ${n} card(s) to players\' hand');
    } elseif ($automatic === true) {
      $msg = clienttranslate('${player_name} discards ${n} card(s)');
    }

    // deleting meeples first
    if (!empty($deleted)) {
      Notifications::silentKill($deleted);
    }

    if ($args['destination'] == HAND) {
      Notifications::moveToHand($player, $cards, $msg, null, [
        'source' => $args['source'],
        'destination' => $args['destination'],
      ]);
    } else {
      Notifications::publicDiscard($player, $cards, $msg, ['source' => $args['source'], 'destination' => $args['destination']]);
    }

    $notified = [];
    foreach ($cards as $cId => $card) {
      if (in_array($card->getPlayer()->getId(), $notified)) {
        continue;
      }
      $notified[] = $card->getPlayer()->getId();
      Notifications::updateBiomes($card->getPlayer());
    }

    $this->resolveAction([$cardIds]);
  }
}
