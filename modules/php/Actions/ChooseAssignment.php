<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Managers\Actions;
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
    if (count($this->getArg('actions')) == 3) {
      return clienttranslate('Choose an assignment');
    } else {
      return clienttranslate('Play a card');
    }
  }

  protected $args = [
    'types' => [PERMANENT, SPELL, CHARACTER],
    'actions' => ['play', 'support', 'tap'],
    'maxHandCost' => INFTY,
    'free' => false,
  ];

  public function argsChooseAssignment()
  {
    $player = Players::getActive();
    $handCards = $player->getHand();
    $reserveCards = $player->getReserveCards();
    $actions = ['play' => [], 'support' => [], 'tap' => []];
    $authorizedTypes = $this->getArg('types');
    $authorizedActions = $this->getArg('actions');
    $maxHandCost = $this->getArg('maxHandCost');
    $free = $this->getArg('free');

    // 1. Play cards
    if (in_array('play', $authorizedActions)) {
      $actions['play'] = $handCards
        ->merge($reserveCards)
        ->filter(function ($card) use ($player, $authorizedTypes, $maxHandCost, $free) {
          return in_array($card->getType(), $authorizedTypes) &&
            ((!$free && $card->canBePlayed($player)) || ($free && $card->getCostHand() <= $maxHandCost && !$card->isTapped()));
        })
        ->map(function ($card) use ($player) {
          return $card->getPlayableLocation($player);
        });

      // Scout is only for hand cards
      $scouts =  $handCards
        ->filter(function ($card) use ($player, $authorizedTypes, $maxHandCost, $free) {
          return $card->getScout() > 0 && in_array($card->getType(), $authorizedTypes) &&
            ((!$free && $card->canBePlayed($player, true)) || ($free && $card->getCostHand() <= $maxHandCost && !$card->isTapped()));
        })
        ->map(function ($card) use ($player) {
          return $card->getScoutableLocations($player);
        });
      foreach ($scouts as $key => $locs) {
        $actions['play'][$key] = array_merge($actions['play'][$key] ?? [], $locs);
      }
      // $actions['play'] = $actions['play']; //->merge($scouts);
      $actions['toto'] = $scouts;
    }

    // 2. Support
    if (in_array('support', $authorizedActions)) {
      $actions['support'] = $reserveCards
        ->filter(function ($card) use ($player) {
          return !empty($card->getEffectSupport()) && (
            !$card->isTapped()
          );
        })
        ->getIds();
    }

    // 3. Tap effect
    if (in_array('tap', $authorizedActions)) {
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
    }
    $additionalAction = count($this->getArg('actions')) != 3;

    return ['_private' => ['active' => $actions], 'additionalAction' => $additionalAction, 'descSuffix' => $additionalAction ? 'additional' : ''];
  }

  public function isOptional($player)
  {
    return $this->getCtx()->getOptional() == true || (count($this->getArg('actions')) != 3 && empty($this->argsChooseAssignment()['_private']['active']['play']->toArray() ?? []));
  }

  public static function statPlay($carId)
  {
    $player = Players::getActive();
    $statMapping = Globals::getStatMapping()[$player->getId()] ?? null;
    if (is_null($statMapping) || !isset($statMapping[$carId])) {
      return;
    }

    $f = 'get' . ucfirst($statMapping[$carId]);
    $stat = Stats::$f($player);

    if ($stat < 200000) {
      // we flag the card as played
      $f = 'set' . ucfirst($statMapping[$carId]);
      Stats::$f($player, $stat + 100000);
    }
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
    $scout = false;
    $args = $this->argsChooseAssignment()['_private']['active']['play'];
    $locations = $args[$cardId] ?? null;
    if (is_null($locations)) {
      throw new \BgaVisibleSystemException('This card cannot be played. Should not happen');
    }
    if (!in_array($location, $locations)) {
      throw new \BgaVisibleSystemException('Invalid location to play a card. Should not happen');
    }
    $locExploded = explode('_', $location);
    if ($locExploded[1] ?? '' == 'scout') {
      $scout = true;
    }

    $this->playCard($cardId, $location, $this->getArg('free'), true, 0, true, $scout);
  }

  public function playCard($cardId, $location, $free = false, $effectHand = true, $newCost = 0, $reallyPlayed = true, $scout = false)
  {
    $player = Players::getActive();
    $card = Cards::get($cardId);
    $location = explode('_', $location)[0];

    if ($card->getPId() != $player->getId()) {
      throw new \BgaVisibleSystemException('You do not own this card. Should not happen');
    }

    if ($free == false) {
      // Calculate cost
      $cost = $card->getCost($scout);
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
      // Has to update cost here as cost is dynamic where it's played
      if ($card->getCostReductionIfEmpty() > 0 && $player->countCardsInLocation($location, [TOKEN, CHARACTER]) == 0 && !$player->hasGigantic()) {
        $cost -= $card->getCostReductionIfEmpty();
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

    if (($card->getType() == SPELL && Globals::isNextSpellIsFree()) || ($free == true && $cost == 0)) {
      Globals::setPlayedForFree(true);
    }
    // Move card
    $fromLocation = $card->getLocation();
    $card->setLocation($location);
    $card->setTapped(false);
    $newState = Cards::getNextPlayedState();
    $newState++;
    $card->setState($newState);

    // notification
    Notifications::playCard($player, $card, $cost, $fromLocation, $location);

    // When does this happens ????
    if ($location == DISCARD) {
      $deleted = $card->discard();
      Notifications::silentKill($deleted);
    }
    // if played from reserve, it gains fleeting
    elseif ($fromLocation == RESERVE && !in_array(LANDMARK, $card->getSubtypes())) {
      Actions::get(GAIN)->gain($player, $card, FLEETING, 1, null, ['type' => FLEETING]);
    }

    if (Globals::getNextCharacterFleeting() == true) {
      Actions::get(GAIN)->gain($player, $card, FLEETING, 1, null, ['type' => FLEETING]);
      Globals::setNextCharacterFleeting(false);
    }

    // should we boost the card
    if (in_array($card->getType(), [CHARACTER, TOKEN]) && Globals::getNextCharacterBoost() > 0) {
      $this->pushParallelChild(FT::GAIN($card, BOOST, Globals::getNextCharacterBoost()));
      Globals::setNextCharacterBoost(0);
    }
    if ($fromLocation == RESERVE && $card->getType() == CHARACTER && Globals::getNextReserveCharacterBoost()) {
      $this->pushParallelChild(FT::GAIN($card, BOOST, Globals::getNextReserveCharacterBoost()));
      Globals::setNextReserveCharacterBoost(0);
    }
    // The undergrowth
    if (Globals::getNextCharacterBoostV() > 0 && $card->getType() == CHARACTER && $player->isInBiome($location, FOREST, true)) {
      $this->pushParallelChild(FT::GAIN($card, BOOST, Globals::getNextCharacterBoostV()));
      Globals::setNextCharacterBoostV(0);
    }

    // should we anchor the character?
    if (
      Globals::getNextCharacterCost3Anchored() == true &&
      in_array($card->getType(), [CHARACTER, TOKEN]) &&
      $card->getCostHand() <= 3
    ) {
      $this->pushParallelChild(FT::GAIN($card, ANCHORED));
      Globals::setNextCharacterCost3Anchored(false);
    }

    if (
      Globals::getNextCharacterAnchored() == true &&
      in_array($card->getType(), [CHARACTER, TOKEN])
    ) {
      $this->pushParallelChild(FT::GAIN($card, ANCHORED));
      Globals::setNextCharacterAnchored(false);
    }


    if (
      ($card->getType() == CHARACTER && !Players::hasOpponentBlockingPower($player, $location)) ||
      $card->getType() != CHARACTER
    ) {
      $effects = [];

      if ($scout) {
        $effects[] = FT::ACTION(DISCARD, ['cardId' => $card->getId(), 'from' => $location, 'destination' => RESERVE]);
      }

      // insert effect flow
      $effect = $card->getEffectPlayed();
      if (!empty($effect)) {
        if (isset($effect['type']) && $effect['type'] == NODE_PARALLEL) {
          foreach ($effect['childs'] as $t => $child) {
            $effects[] = $child;
          }
        } else {
          $effects[] = $effect;
        }
      }

      if ($fromLocation == HAND && $effectHand) {
        $effect = $card->getEffectHand();
        if (!empty($effect)) {
          if (isset($effect['type']) && $effect['type'] == NODE_PARALLEL) {
            foreach ($effect['childs'] as $t => $child) {
              $effects[] = $child;
            }
          } else {
            $effects[] = $effect;
          }
        }
      }

      if ($fromLocation == RESERVE) {
        $effect = $card->getEffectReserve();
        if (!empty($effect)) {
          if (isset($effect['type']) && $effect['type'] == NODE_PARALLEL) {
            foreach ($effect['childs'] as $t => $child) {
              $effects[] = $child;
            }
          } else {
            $effects[] = $effect;
          }
        }
      }

      // if it's a spell, effect are resolved immediately
      if ($card->getType() == SPELL) {

        if ($fromLocation == HAND && Globals::getRemoveFleetingIfSpellPlayedHand() == true) {
          $effects[] = FT::LOOSE($card->getId(), FLEETING);
        } elseif (Globals::getRemoveFleetingSpellPlayed() == true) {
          $effects[] = FT::LOOSE($card->getId(), FLEETING);
        } elseif ((in_array(ARTIST, $card->getSubtypes()) || in_array(SONG, $card->getSubtypes())) && Globals::getRemoveFleetingSongArtistPlayed()) {
          $effects[] = FT::LOOSE($card->getId(), FLEETING);
        }
        if (!empty($effects)) {
          $effects = Utils::tagTree(['childs' => $effects], ['sourceId' => $card->getId()]);
          foreach ($effects as &$eff['childs']) {
            if (isset($eff['pId'])) {
              continue;
            }
            $eff['pId'] = $card->getPId();
          }
          $spellAction = FT::SEQ(FT::PAR($effects), ['action' => SPELL_CLEANUP, 'args' => ['cardId' => $card->getId()], 'pId' => $player->getId()]);
        } else {
          $spellAction = ['action' => SPELL_CLEANUP, 'args' => ['cardId' => $card->getId()], 'pId' => $player->getId()];
        }
        $this->insertAsChild($spellAction);
        $effects = [];
      } else {
        // resolving current node as some things are inserted before and after
        Engine::resolveAction();
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
        // setting a default PId for the effects
        foreach ($effects as &$eff) {
          if (isset($eff['pId'])) {
            continue;
          }
          $eff['pId'] = $card->getPId();
        }
        $effects = Utils::tagTree(['childs' => $effects], ['sourceId' => $card->getId()]);
        // $effects = Utils::tagTree($effects, ['pId' => $player->getId()]);
        $this->pushAfterFinishingChilds($effects['childs']);
        if ($card->getRarity() == RARITY_UNIQUE) {
          $this->updateAfterFinishingChilds(['noIndependent' => true]);
        }
      }
    } else {
      Notifications::message(clienttranslate('Effects are not triggered, due to an effect in the opponent\'s expedition'), []);
    }
    $this->checkImmediateListeners($player, [
      'playCard' => true,
      'cardId' => $cardId,
      'cardType' => $card->getType(),
      'from' => $fromLocation,
      'to' => $location,
      'playedFree' => $cost == 0 ? true : false,
      'putAndNotPlayed' => !$effectHand,
      'additionalEffects' => Globals::getAdditionalEffect()
    ]);

    $this->checkAfterListeners($player, [
      'playCard' => true,
      'cardId' => $cardId,
      'cardType' => $card->getType(),
      'from' => $fromLocation,
      'reallyPlayed' => $reallyPlayed,
      'to' => $location,
      'gigantic' => $card->isGigantic(),
      'playedFree' => $cost == 0 ? true : false,
      'putAndNotPlayed' => !$effectHand,
      'additionalEffects' => Globals::getAdditionalEffect()
    ]);
    // throw new \feException(print_r(Globals::getEngine()));

    // we reset this at this stage, as if we do it previously, checkAFterListeners doesn't have the correct info (for trigger of Bravos Bastion)
    Globals::setAdditionalEffect([]);
    self::statPlay($cardId);
    $baseStat0 = false;
    foreach ($card->getBiomes() as $biome => $value) {
      if ($value == 0) {
        $baseStat0 = true;
      }
    }

    // Cleanup resolution at end of spell not end of turn
    // if ($card->getType() == SPELL) {
    //   if ($fromLocation == HAND && Globals::getRemoveFleetingIfSpellPlayedHand() == true) {
    //     Engine::insertAtRoot(FT::LOOSE($card->getId(), FLEETING));
    //   } elseif (Globals::getRemoveFleetingSpellPlayed() == true) {
    //     Engine::insertAtRoot(FT::LOOSE($card->getId(), FLEETING));
    //   }

    //   Engine::insertAtRoot(['action' => SPELL_CLEANUP, 'args' => ['cardId' => $card->getId()], 'pId' => $player->getId()]);
    // } else
    if (in_array($card->getType(), [CHARACTER, TOKEN]) && Globals::getRemoveFleetingCharacterPlayed()) {
      Engine::insertAtRoot(FT::LOOSE($card->getId(), FLEETING));
    } elseif (in_array($card->getType(), [CHARACTER, TOKEN]) && Globals::getRemoveFleetingCharacterStat0Played() && $baseStat0) {
      Engine::insertAtRoot(FT::LOOSE($card->getId(), FLEETING));
    } elseif ((in_array(ARTIST, $card->getSubtypes()) || in_array(SONG, $card->getSubtypes())) && Globals::getRemoveFleetingSongArtistPlayed()) {
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
    self::statPlay($cardId);

    $effect = $card->getEffectSupport();
    if (!empty($effect)) {
      $effect = Utils::tagTree($effect, ['sourceId' => $card->getId()]);
      // $effect = Utils::tagTree($effect, ['pId' => $player->getId()]);
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
      // $effect = Utils::tagTree($effect, ['pId' => $player->getId()]);
      // throw new \feException(print_r($effect));
      $this->insertAsChild($effect);
    }

    $this->checkAfterListeners($player, [
      'cardId' => $card->getId(),
      'cardLocation' => $card->getLocation(),
      'sourceId' => $card->getId(),
    ], true, 'Exhaust');
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
