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

class ChooseAssignment extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_CHOOSE_ASSIGNMENT;
  }

  public function getDescription()
  {
    return clienttranslate('Choose an assignment');
  }

  public function argsChooseAssignment()
  {
    $player = Players::getActive();
    $handCards = $player->getHand();
    $memoryCards = $player->getMemoryCards();
    $actions = ['hand' => [], 'memory' => [], 'echo' => [], 'hero' => [], 'tap' => []];

    // calculate
    // 1. hand cards
    $actions['hand'] = $handCards->filter(function ($card) use ($player) {
      return $card->canBePlayed($player);
    });

    // 2. Memory cards (callback effect)
    $actions['memory'] = $memoryCards->filter(function ($card) use ($player) {
      return $card->canBePlayed($player);
    });

    // 3. Echo
    $actions['echo'] = $memoryCards->filter(function ($card) {
      return !is_null($card->getEffectEcho());
    });

    // 4. Permanent/tap effect
    $actions['tap'] = $player->getPlayedCards()->filter(function ($card) {
      return !$card->isTapped() && !is_null($card->getEffectTap());
    });
    // TODO: add hero

    return ['_private' => ['active' => $actions]];
  }

  public function actHand($cardId, $to = null)
  {
    self::checkAction('actHand');
    $player = Players::getActive();
    $args = $this->argsChooseAssignment()['_private']['active']['hand'];
    if (!in_array($to, STORMS)) {
      throw new \BgaVisibleSystemException('Invalid location to play a card. Should not happen');
    }
    if (!isset($args[$cardId])) {
      throw new \BgaVisibleSystemException('This card cannot be played. Should not happen');
    }

    $this->playCardInStorm($cardId, HAND, $to);
  }

  public function actMemory($cardId, $to = null)
  {
    self::checkAction('actMemory');
    $player = Players::getActive();
    $args = $this->argsChooseAssignment()['_private']['active']['memory'];
    if (!in_array($to, STORMS)) {
      throw new \BgaVisibleSystemException('Invalid location to play a card. Should not happen');
    }
    if (!isset($args[$cardId])) {
      throw new \BgaVisibleSystemException('This card cannot be played. Should not happen');
    }

    $this->playCardInStorm($cardId, MEMORY, $to);
  }

  public function playCardInStorm($cardId, $location, $to = null)
  {
    $player = Players::getActive();
    $card = Cards::get($cardId);
    if ($card->getPId() != $player->getId()) {
      throw new \BgaVisibleSystemException('You do not own this card. Should not happen');
    }

    if ($card->getLocation() != $location) {
      throw new \BgaVisibleSystemException('Location of the card is not ok. Should not happen');
    }

    // Pay cost
    $cost = $card->getCost();
    $player->pay($cost);
    // left or right storm
    $card->setLocation($to);

    // notification
    Notifications::playCard($player, $card, $cost, $location, $to);

    // if played from memory, it gains fleeting
    if ($location == MEMORY) {
      $card->setProperty(FLEETING, true);
      Notifications::gainToken(FLEETING, $card);
    }

    // insert linked flow
    $effect = 'getEffect' . ucfirst($location);
    Globals::incPlayedCards();
    // TODO: remove
    // $this->pushParallelChilds($card->$effect());
    $this->resolveAction([$cardId, $to]);
  }

  public function actEcho($cardId)
  {
    // echo management
    self::checkAction('actEcho');
    $player = Players::getActive();
    $args = $this->argsChooseAssignment()['_private']['active']['echo'];

    if (!isset($args[$cardId])) {
      throw new \BgaVisibleSystemException('This card cannot be played. Should not happen');
    }

    $card = Cards::get($cardId);
    Cards::discard($cardId, 'discard', $player->getId());
    Notifications::echoEffect($player, $card);
    // TODO: remove
    // $this->pushParallelChilds($card->getEffectEcho());

    $this->resolveAction([$cardId, 'echo']);
  }

  public function actTap($cardId)
  {
    self::checkAction('actTap');
    $player = Players::getActive();
    $args = $this->argsChooseAssignment()['_private']['active']['tap'];

    if (!isset($args[$cardId])) {
      throw new \BgaVisibleSystemException('This card cannot be tapped. Should not happen');
    }
    $card = Cards::get($cardId);
    $card->setTapped(true);
    Notifications::tapEffect($player, $card);

    // TODO: remove
    // $this->pushParallelChilds($card->getEffectTap());
    $this->resolveAction([$cardId, 'tap']);
  }

  public function actPass($silent = false)
  {
    self::checkAction('actPass');
    $player = Players::getActive();
    if (!$silent) {
      Notifications::pass($player);
    }
    $this->resolveAction(['pass']);
  }
}
