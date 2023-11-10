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
        if ($type == CHARACTER) {
          return [STORM_LEFT, STORM_RIGHT];
        }
        return [];
      });

    // 2. Echo
    $actions['echo'] = $memoryCards
      ->filter(function ($card) {
        return !empty($card->getEffectEcho());
      })
      ->getIds();

    // 3. Permanent/tap effect
    $actions['tap'] = $player
      ->getPlayedCards()
      ->merge($player->getHeroCollection())
      ->filter(function ($card) use ($player) {
        return !$card->isTapped() &&
          !is_null($card->getEffectTap()) &&
          !empty($card->getEffectTap()) &&
          Engine::buildTree($card->getEffectTap())->isDoable($player);
      })
      ->getIds();

    return ['_private' => ['active' => $actions]];
  }

  ///////////////////////////
  //  ____  _
  // |  _ \| | __ _ _   _
  // | |_) | |/ _` | | | |
  // |  __/| | (_| | |_| |
  // |_|   |_|\__,_|\__, |
  //                |___/
  ///////////////////////////

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
    $costReduction = Globals::getCostReduction();
    if (isset($costReduction[$player->getId()][$card->getType()])) {
      unset($costReduction[$player->getId()][$card->getType()]);
      Globals::setCostReduction($costReduction);
    }

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
    } elseif ($fromLocation == MEMORY && $location != PERMANENT) {
      $token = Meeples::createOnCard(FLEETING, $cardId, $player->getId());
      Notifications::gainMeeple(FLEETING, $card, $token);
    }
    // insert effect flow
    $effect = $card->getEffectPlayed();
    if (empty($effect) && $fromLocation == HAND) {
      $effect = $card->getEffectHand();
    }

    if (empty($effect) && $fromLocation == MEMORY) {
      $effect = $card->getEffectMemory();
    }

    if (!empty($effect)) {
      $effect = Utils::tagTree($effect, ['sourceId' => $card->getId()]);
      $this->insertAsChild($effect);
    }

    // TODO: put in in invoke
    $this->checkAfterListeners($player, ['playCard' => true, 'playedCard' => $cardId, 'cardType' => $card->getType()]);

    if ($card->getType() == SPELL) {
      Engine::insertAtRoot(['action' => SPELL_CLEANUP, 'args' => ['cardId' => $card->getId()]]);
    }
  }

  /////////////////////////////
  //  _____     _
  // | ____|___| |__   ___
  // |  _| / __| '_ \ / _ \
  // | |__| (__| | | | (_) |
  // |_____\___|_| |_|\___/
  /////////////////////////////

  public function actEcho($cardId)
  {
    $player = Players::getActive();
    $args = $this->argsChooseAssignment()['_private']['active']['echo'];

    if (!in_array($cardId, $args)) {
      throw new \BgaVisibleSystemException('This card cannot be played. Should not happen');
    }

    $card = Cards::get($cardId);
    Cards::discard($cardId, 'discard', $player->getId());
    Notifications::echoEffect($player, $card);

    $effect = $card->getEffectEcho();
    if (!empty($effect)) {
      $effect = Utils::tagTree($effect, ['sourceId' => $card->getId()]);
      $this->insertAsChild($effect);
    }
  }

  ////////////////////////
  //  _____
  // |_   _|_ _ _ __
  //   | |/ _` | '_ \
  //   | | (_| | |_) |
  //   |_|\__,_| .__/
  //           |_|
  ////////////////////////
  public function actTap($cardId)
  {
    $player = Players::getActive();
    $args = $this->argsChooseAssignment()['_private']['active']['tap'];

    if (!in_array($cardId, $args)) {
      throw new \BgaVisibleSystemException('This card cannot be tapped. Should not happen');
    }
    $card = Cards::get($cardId);
    $card->setTapped(true);
    Notifications::tapEffect($player, $card);

    $effect = $card->getEffectTap();
    if (!empty($effect)) {
      $effect = Utils::tagTree($effect, ['sourceId' => $card->getId()]);
      $this->insertAsChild($effect);
    }
  }

  ////////////////////////////
  //  ____
  // |  _ \ __ _ ___ ___
  // | |_) / _` / __/ __|
  // |  __/ (_| \__ \__ \
  // |_|   \__,_|___/___/
  ////////////////////////////
  public function actPass()
  {
    $player = Players::getActive();
    $skipped = Globals::getSkippedPlayers();
    $skipped[] = $player->getId();
    Globals::setSkippedPlayers($skipped);
    Notifications::pass($player);
  }
}
