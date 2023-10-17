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
use ALT\Helpers\FlowConvertor;
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
    $actions = ['play' => [], 'echo' => [], 'tap' => []];

    // 1. Play cards
    $actions['play'] = $handCards
      ->merge($memoryCards)
      ->filter(function ($card) use ($player) {
        return $card->canBePlayed($player);
      })
      ->map(function ($card) {
        $type = $card->getType();
        if ($type == PERMANENT) {
          return [PERMANENT];
        }
        if ($type == SPELL) {
          return [LIMBO];
        }
        if ($type == EXPLORER) {
          return [STORM_LEFT, STORM_RIGHT];
        }
        return [];
      });

    // 2. Echo
    $actions['echo'] = $memoryCards
      ->filter(function ($card) {
        return !is_null($card->getEffectEcho());
      })
      ->getIds();

    // 3. Permanent/tap effect
    $actions['tap'] = $player->getPlayedCards()->filter(function ($card) {
      return !$card->isTapped() && !is_null($card->getEffectTap());
    });
    // TODO: add hero

    return ['_private' => ['active' => $actions]];
  }

  public function actPlay($cardId, $location)
  {
    $args = $this->argsChooseAssignment()['_private']['active']['play'];
    $locations = $args[$cardId] ?? null;
    if (is_null($locations)) {
      throw new \BgaVisibleSystemException('This card cannot be played. Should not happen');
    }
    if (!in_array($location, $locations)) {
      throw new \BgaVisibleSystemException('Invalid location to play a card. Should not happen');
    }

    $this->playCard($cardId, $location);
    $this->resolveAction([$cardId, $location]);
  }

  public function playCard($cardId, $location)
  {
    $player = Players::getActive();
    $card = Cards::get($cardId);
    if ($card->getPId() != $player->getId()) {
      throw new \BgaVisibleSystemException('You do not own this card. Should not happen');
    }

    // Pay cost
    $cost = $card->getCost();
    $player->payMana($cost);
    // Move card
    $fromLocation = $card->getLocation();
    $card->setLocation($location);
    Globals::incPlayedCards();

    // notification
    Notifications::playCard($player, $card, $cost, $fromLocation, $location);

    // if played from memory, it gains fleeting
    if ($location == DISCARD) {
      $deleted = $card->discard();
      Notifications::silentKill($deleted);
    } elseif ($fromLocation == MEMORY) {
      $token = Meeples::createOnCard(FLEETING, $cardId, $player->getId());
      Notifications::gainToken(FLEETING, $card, $token);
    }

    // insert linked flow
    $effect = 'getEffect' . ucfirst($fromLocation);
    list($power) = FlowConvertor::getFlow($card->$effect(), null, null, $cardId);
    // if (!isset($power['args']['cardId'])) {
    //   $power['args']['cardId'] = $cardId;
    // }
    // throw new \feException(print_r($power));

    $this->pushParallelChilds($power);

    if ($card->getType() == SPELL) {
      Engine::insertAtRoot(['action' => SPELL_CLEANUP, 'args' => ['cardId' => $card->getId()]]);
    }
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
    $player = Players::getActive();
    $skipped = Globals::getSkippedPlayers();
    $skipped[] = $player->getId();
    Globals::setSkippedPlayers($skipped);
    if (!$silent) {
      Notifications::pass($player);
    }
  }
}
