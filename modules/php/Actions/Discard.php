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
    return clienttranslate('Discard TODO');
  }

  public function argsDiscard()
  {
    $player = Players::getCurrent();
    if ($this->getCtxArg('source') == HAND) {
      $cards = $player->getHand()->getIds();
    } elseif ($this->getCtxArg('source') == MEMORY) {
      $cards = $player->getMemoryCards()->getIds();
    } else {
      $cards = $player->getPlayedCards()->getIds();
    }
    return [
      'n' => $this->getCtxArg('n') ?? 1,
      'source' => $this->getCtxArg('source'),
      'destination' => $this->getCtxArg('destination'),
      '_private' => [
        'active' => [
          'cards' => $cards,
        ],
      ],
    ];
  }

  public function actDiscard($cardIds)
  {
    self::checkAction('actDiscard');
    $player = Players::getActive();
    $args = $this->argsDiscard();

    if (count($cardIds) != $args['n']) {
      throw new \BgaVisibleSystemException('You must select the correct number of cards. Should not happen');
    }

    if (!empty(array_diff($cardIds, $args['_private']['active']['cards']))) {
      throw new \BgaVisibleSystemException('You selected a card that should not be discarded. Should not happen');
    }

    Cards::discard($cardIds);
    $cards = Cards::getMany($cardIds, $args['destination']);
    // throw new \feException($cards->first()->getId());
    Notifications::discard(
      $player,
      $cards,
      null,
      clienttranslate('${player_name} discards ${n} cards from the ${source} to ${destination}'),
      ['source' => $args['source'], 'destination' => $args['destination']]
    );
    $this->resolveAction([$cardIds]);
  }
}
