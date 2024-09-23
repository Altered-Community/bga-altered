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
use ALT\Helpers\FT;

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
    $reserveCards = $player->getReserveCards();
    $actions = ['play' => [], 'support' => [], 'tap' => []];

    // 1. Play cards
    $actions['play'] = $handCards
      ->merge($reserveCards)
      ->filter(function ($card) use ($player) {
        return $card->canBePlayed($player);
      })
      ->map(function ($card) {
        $type = $card->getType();
        $subTypes = $card->getSubtypes();
        if ($type == PERMANENT && !in_array(LANDMARK, $subTypes)) {
          return [PERMANENT];
        } elseif ($type == PERMANENT && in_array(LANDMARK, $subTypes)) {
          return [LANDMARK];
        } elseif ($type == SPELL) {
          return [LIMBO];
        } elseif ($type == CHARACTER) {
          return [STORM_LEFT, STORM_RIGHT];
        }
        return [];
      });

    // 2. Support
    $actions['support'] = $reserveCards
      ->filter(function ($card) {
        return !empty($card->getEffectSupport());
      })
      ->getIds();

    // 3. Tap effect
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
  }

  public function playCard($cardId, $location, $free = false, $effectHand = true, $newCost = 0)
  {
    $player = Players::getActive();
    $card = Cards::get($cardId);
    if ($card->getPId() != $player->getId()) {
      throw new \BgaVisibleSystemException('You do not own this card. Should not happen');
    }

    if ($free == false) {
      // Calculate cost
      $cost = $card->getCost();
      $costReduction = Globals::getCostReduction();
      if (isset($costReduction[$player->getId()][$card->getType()])) {
        unset($costReduction[$player->getId()][$card->getType()]);
      }

      foreach ($card->getSubtypes() as $subtype) {
        if (isset($costReduction[$player->getId()][$subtype])) {
          unset($costReduction[$player->getId()][$subtype]);
        }
      }

      if (isset($costReduction[$player->getId()][ALL])) {
        unset($costReduction[$player->getId()][ALL]);
      }
      Globals::setCostReduction($costReduction);
      Globals::incPlayedCards();

      // management of CostReductionDiscard, discarding a card from reserve to reduce cost
      if ($card->getCostReductionDiscard() > 0) {
        if (
          ($card->getLocation() == RESERVE && $player->getReserveCards()->count() > 1) ||
          ($card->getLocation() != RESERVE && $player->getReserveCards()->count() > 0)
        ) {
          $this->insertAsChild(
            FT::XOR(
              FT::ACTION(PLAY_CARD, ['cardId' => $cardId, 'free' => true, 'location' => $location, 'cost' => $cost]),
              FT::SEQ(
                FT::ACTION(
                  TARGET,
                  [
                    'targetLocation' => [RESERVE],
                    'targetPlayer' => ME,
                    'excludeSelf' => true,
                    'targetType' => [CHARACTER, TOKEN, SPELL, PERMANENT],
                    'effect' => FT::ACTION(DISCARD, []),
                  ],
                  ['sourceId' => $cardId]
                ),
                FT::ACTION(PLAY_CARD, [
                  'cardId' => $cardId,
                  'free' => true,
                  'cost' => $cost - $card->getCostReductionDiscard(),
                  'location' => $location,
                ])
              )
            )
          );
          $this->resolveAction(['CostReduction']);
          return;
        }
      }

      // Pay cost
      $player->payMana($cost);
    } elseif ($newCost > 0) {
      Globals::incPlayedCards();
      $player->payMana($newCost);
      $cost = $newCost;
    } else {
      $cost = 0;
    }

    if ($card->getType() == SPELL && Globals::isNextSpellIsFree()) {
      Globals::setPlayedForFree(true);
    }
    // Move card
    $fromLocation = $card->getLocation();
    $card->setLocation($location);

    // notification
    Notifications::playCard($player, $card, $cost, $fromLocation, $location);

    // When does this happens ????
    if ($location == DISCARD) {
      $deleted = $card->discard();
      Notifications::silentKill($deleted);
    }
    // if played from reserve, it gains fleeting
    elseif ($fromLocation == RESERVE && $card->getType() != PERMANENT) {
      $token = Meeples::createOnCard(FLEETING, $cardId, $player->getId());
      Notifications::gainMeeple(FLEETING, $card, $token);
    }

    // should we boost the card
    if (in_array($card->getType(), [CHARACTER, TOKEN]) && Globals::getNextCharacterBoost() > 0) {
      $this->insertAsChild(FT::GAIN($card, BOOST, Globals::getNextCharacterBoost()));
      Globals::setNextCharacterBoost(0);
    }

    // should we anchor the character?
    if (
      Globals::getNextCharacterCost3Anchored() == true &&
      in_array($card->getType(), [CHARACTER, TOKEN]) &&
      $card->getCostHand() <= 3
    ) {
      $this->insertAsChild(FT::GAIN($card, ANCHORED));
      Globals::setNextCharacterCost3Anchored(false);
    }

    if (
      ($card->getType() == CHARACTER && !Players::hasOpponentBlockingPower($player, $location)) ||
      $card->getType() != CHARACTER
    ) {
      $effects = [];
      // insert effect flow
      $effect = $card->getEffectPlayed();
      if (!empty($effect)) {
        $effects[] = $effect;
      }

      if ($fromLocation == HAND && $effectHand) {
        $effect = $card->getEffectHand();
        if (!empty($effect)) {
          $effects[] = $effect;
        }
      }

      if ($fromLocation == RESERVE) {
        $effect = $card->getEffectReserve();
        if (!empty($effect)) {
          $effects[] = $effect;
        }
      }

      if (Globals::getAdditionalEffect() != []) {
        $addEffects = Globals::getAdditionalEffect();
        foreach ($addEffects as $addEffect) {
          if ($addEffect['type'] == $card->getType()) {
            if ($addEffect['from'] == $fromLocation) {
              $effectType = $addEffect['effect'];
              $f = 'getEffect' . ucfirst($effectType);
              $newEffect = $card->$f();
              if (!empty($newEffect)) {
                $effects[] = $newEffect;
              }
            }
          }
        }
      }

      if (!empty($effects)) {
        $effects = Utils::tagTree(['childs' => $effects], ['sourceId' => $card->getId()]);
        $this->pushParallelChilds($effects['childs']);
      }
    } else {
      Notifications::message(clienttranslate('Effects are not triggered, due to an effect in the opponent\'s expedition'), []);
    }

    $this->checkAfterListeners($player, [
      'playCard' => true,
      'cardId' => $cardId,
      'cardType' => $card->getType(),
      'from' => $fromLocation,
      'to' => $location,
      'playedFree' => $cost == 0 ? true : false,
      'putAndNotPlayed' => !$effectHand,
      'additionalEffects' => Globals::getAdditionalEffect()
    ]);

    // we reset this at this stage, as if we do it previously, checkAFterListeners doesn't have the correct info (for trigger of Bravos Bastion)
    Globals::setAdditionalEffect([]);

    if ($card->getType() == SPELL) {
      if ($fromLocation == HAND && Globals::getRemoveFleetingIfSpellPlayedHand() == true) {
        Engine::insertAtRoot(FT::LOOSE($card->getId(), FLEETING));
      } elseif (Globals::getRemoveFleetingSpellPlayed() == true) {
        Engine::insertAtRoot(FT::LOOSE($card->getId(), FLEETING));
      }

      Engine::insertAtRoot(['action' => SPELL_CLEANUP, 'args' => ['cardId' => $card->getId()]]);
    } elseif (in_array($card->getType(), [CHARACTER, TOKEN]) && Globals::getRemoveFleetingCharacterPlayed()) {
      Engine::insertAtRoot(FT::LOOSE($card->getId(), FLEETING));
    }
  }

  /////////////////////////////
  //  _____     _
  // | ____|___| |__   ___
  // |  _| / __| '_ \ / _ \
  // | |__| (__| | | | (_) |
  // |_____\___|_| |_|\___/
  /////////////////////////////

  public function actSupport($cardId)
  {
    $player = Players::getActive();
    $args = $this->argsChooseAssignment()['_private']['active']['support'];

    if (!in_array($cardId, $args)) {
      throw new \BgaVisibleSystemException('This card cannot be played as support. Should not happen');
    }

    $card = Cards::get($cardId);
    Cards::discard($cardId, 'discard');
    Notifications::supportEffect($player, $card);

    $effect = $card->getEffectSupport();
    if (!empty($effect)) {
      $effect = Utils::tagTree($effect, ['sourceId' => $card->getId()]);
      $this->insertAsChild($effect);
    }

    $this->checkAfterListeners($player, [
      'cardId' => $cardId,
      'playCard' => false,
      'cardType' => $card->getType(),
      'from' => RESERVE,
    ]);
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
