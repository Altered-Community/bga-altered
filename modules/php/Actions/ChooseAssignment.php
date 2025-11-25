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
    'maxBaseCost' => INFTY,
    'minBaseCost' => 0,
    'limited' => false,
    'forcedLocation' => null,
    'mandatory' => false
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
    $maxBaseCost = $this->getArg('maxBaseCost');
    $minBaseCost = $this->getArg('minBaseCost');
    $free = $this->getArg('free');
    $forcedLocation = $this->getArg('forcedLocation');

    // 1. Play cards
    if (in_array('play', $authorizedActions)) {
      $actions['play'] = $handCards
        ->merge($reserveCards)
        ->filter(function ($card) use ($player, $authorizedTypes, $maxHandCost, $free, $maxBaseCost, $minBaseCost) {
          return (in_array($card->getType(), $authorizedTypes) || count(array_intersect($authorizedTypes, $card->getAdditionalType())) > 0) &&
            ((!$free && $card->canBePlayed($player)) || ($free && $card->getCostHand() <= $maxHandCost  && $card->getMinManaOrbs() <= $player->getTotalMana() && !$card->isTapped() &&
              (($card->getLocation() == HAND && $card->getCostHand() <= $maxBaseCost) || ($card->getLocation() == RESERVE && $card->getCostReserve() <= $maxBaseCost)) &&
              (($card->getLocation() == HAND && $card->getCostHand() >= $minBaseCost) || ($card->getLocation() == RESERVE && $card->getCostReserve() >= $minBaseCost))
            ));;
        })
        ->map(function ($card) use ($player, $forcedLocation) {
          return $card->getPlayableLocation($player, $forcedLocation);
        });

      // Scout is only for hand cards
      $scouts =  $handCards
        ->filter(function ($card) use ($player, $authorizedTypes, $maxHandCost, $free) {
          return $card->getScout() > 0 && in_array($card->getType(), $authorizedTypes) &&
            ((!$free && $card->canBePlayed($player, true)) || ($free && $card->getCostHand() <= $maxHandCost && !$card->isTapped()));
        })
        ->map(function ($card) use ($player, $forcedLocation) {
          return $card->getScoutableLocations($player, $forcedLocation);
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
          $effectTap = $card->getEffectTap();
          if (is_null('effectTap') || empty($effectTap)) {
            return false;
          }
          $effectTap['sourceId'] = $card->getId();
          return !$card->isTapped() &&
            Engine::buildTree($effectTap)->isDoable($player);
        })
        ->getIds();
    }
    $additionalAction = count($this->getArg('actions')) != 3;

    return ['_private' => ['active' => $actions], 'additionalAction' => $additionalAction, 'descSuffix' => $additionalAction ? 'additional' : ''];
  }

  public function isOptional($player)
  {
    return $this->getCtx()->getOptional() == true || (count($this->getArg('actions')) != 3 && empty($this->argsChooseAssignment()['_private']['active']['play']->toArray() ?? []) && !$this->getArg('mandatory'));
  }

  public function isDoable($player)
  {
    if ($this->isOptional($player) || !$this->getArg('mandatory')) {
      return true;
    }

    if (count($this->getArg('actions')) != 3 && !empty($this->argsChooseAssignment()['_private']['active']['play']->toArray() ?? [])) {
      return true;
    }

    return false;
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

  public function playCard($cardId, $location, $free = false, $effectHand = true, $newCost = 0, $reallyPlayed = true, $scout = false, $stealOwnership = false)
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
      foreach (($costReduction[$player->getId()] ?? []) as $costType => $reductionCost) {
        if ($card->getType() == $costType || in_array($costType, $card->getAdditionalType())) {
          unset($costReduction[$player->getId()][$costType]);
        }
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
      } elseif ($card->getCostReductionSacrificePermanent() > 0) {
        $nbPermanents = $player->getPlayedCards()->filter(function ($c2) {
          return $c2->getType() == PERMANENT || in_array(PERMANENT, $c2->getAdditionalType());
        })->count();

        if ($nbPermanents > 0) {
          $this->insertAsChild(
            FT::XOR(
              FT::ACTION(PLAY_CARD, ['cardId' => $cardId, 'free' => true, 'location' => $location, 'cost' => $cost]),
              FT::SEQ(
                FT::ACTION(
                  TARGET,
                  [
                    'targetType' => [PERMANENT],
                    'targetPlayer' => ME,
                    'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
                  ],
                  ['sourceId' => $cardId]
                ),
                FT::ACTION(PLAY_CARD, [
                  'cardId' => $cardId,
                  'free' => true,
                  'cost' => $cost - $card->getCostReductionSacrificePermanent(),
                  'location' => $location,
                ])
              )
            )
          );
          $this->resolveAction(['CostReduction']);
          return;
        }
      } elseif ($card->getCostReductionLimitation() > 0) {
        $this->insertAsChild(
          FT::XOR(
            FT::ACTION(PLAY_CARD, ['cardId' => $cardId, 'free' => true, 'location' => $location, 'cost' => $cost]),
            FT::ACTION(PLAY_CARD, ['cardId' => $cardId, 'free' => true, 'location' => $location, 'cost' => $cost - $card->getCostReductionLimitation(), 'limited' => true]),
          )
        );
        $this->resolveAction(['CostReduction']);
        return;
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

    if ((($card->getType() == SPELL || in_array(SPELL, $card->getAdditionalType())) && Globals::isNextSpellIsFree()) || ($free == true && $cost == 0)) {
      Globals::setPlayedForFree(true);
    }
    // Move card
    $fromLocation = $card->getLocation();
    $card->setLocation($location);
    $card->setTapped(false);
    $card->setRevealed(false);

    // if card has boosts (from incorrect passive effect), we remove them

    if ($fromLocation == HAND) {
      $meeples = Meeples::getInLocation('card-' . $card->getId());
      $meepleIds = $meeples->getIds();
      if (!empty($meepleIds)) {
        Meeples::delete($meepleIds);
      }
    } else {
      $meepleIds = [];
    }

    $newState = Cards::getNextPlayedState();
    $newState++;
    $card->setState($newState);

    // notification
    Notifications::playCard($player, $card, $cost, $fromLocation, $location, $meepleIds);

    // When does this happens ????
    if ($location == DISCARD) {
      $deleted = $card->discard();
      Notifications::silentKill($deleted);
    }
    // if played from reserve, it gains fleeting
    elseif ($fromLocation == RESERVE && !in_array(LANDMARK, $card->getSubtypes())) {
      Actions::get(GAIN)->gain($player, $card, FLEETING, 1, null, ['type' => FLEETING]);
    } elseif ($player->getHero()->isAllSpell1Fleeting() && $card->getType() == SPELL && $card->getCostHand() <= 1) {
      Actions::get(GAIN)->gain($player, $card, FLEETING, 1, null, ['type' => FLEETING]);
    }

    if (Globals::getNextCharacterFleeting() == true) {
      Actions::get(GAIN)->gain($player, $card, FLEETING, 1, null, ['type' => FLEETING]);
      Globals::setNextCharacterFleeting(false);
    }

    // should we boost the card
    if (in_array($card->getType(), [CHARACTER, TOKEN]) && Globals::getNextCharacterBoost() > 0) {
      $toBoost = Globals::getNextCharacterBoost();
      $occur = Globals::getNextCharacterBoostOccurence();

      for ($v = 0; $v < $occur - 1; $v++) {
        $this->pushParallelChild(FT::GAIN($card, BOOST, 1));
        $toBoost--;
      }
      if ($toBoost > 0) {
        $this->pushParallelChild(FT::GAIN($card, BOOST, $toBoost));
      }
      Globals::setNextCharacterBoost(0);
      Globals::setNextCharacterBoostOccurence(0);
    }

    if ($fromLocation == RESERVE && $card->getType() == CHARACTER && Globals::getNextReserveCharacterBoost()) {
      $this->pushParallelChild(FT::GAIN($card, BOOST, Globals::getNextReserveCharacterBoost()));
      Globals::setNextReserveCharacterBoost(0);
    }
    // The undergrowth
    if (Globals::getNextCharacterBoostV() > 0 && $card->getType() == CHARACTER && $player->isInBiome($location, FOREST, true)) {
      $toBoost = Globals::getNextCharacterBoostV();
      $occur = Globals::getNextCharacterBoostOccurence();

      for ($v = 0; $v < $occur - 1; $v++) {
        $this->pushParallelChild(FT::GAIN($card, BOOST, 1));
        $toBoost--;
      }
      if ($toBoost > 0) {
        $this->pushParallelChild(FT::GAIN($card, BOOST, $toBoost));
      }
      Globals::setNextCharacterBoostOccurence(0);
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
      ($card->getType() == CHARACTER && !Players::hasOpponentBlockingPower($player, $location, $card->isGigantic())) ||
      $card->getType() != CHARACTER
    ) {
      $effects = [];

      if ($scout) {
        $effects[] = FT::ACTION(DISCARD, ['cardId' => $card->getId(), 'from' => $location, 'destination' => RESERVE]);
      }

      // insert effect flow
      if ($this->getArg('limited') === true) {
        $effect = $card->getEffectPlayedLimited();
      } else {
        $effect = $card->getEffectPlayed();
      }
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
      if ($card->getType() == SPELL || in_array(SPELL, $card->getAdditionalType())) {

        if ($fromLocation == HAND && Globals::getRemoveFleetingIfSpellPlayedHand() == true) {
          $effects[] = FT::LOOSE($card->getId(), FLEETING);
        } elseif (Globals::getRemoveFleetingSpellPlayed() == true) {
          $effects[] = FT::LOOSE($card->getId(), FLEETING);
        } elseif ((in_array(ARTIST, $card->getSubtypes()) || in_array(SONG, $card->getSubtypes())) && Globals::getRemoveFleetingSongArtistPlayed()) {
          $effects[] = FT::LOOSE($card->getId(), FLEETING);
        }
        if ($card->getType() == SPELL) {
          if (!empty($effects)) {
            $effects = Utils::tagTree(['childs' => $effects], ['sourceId' => $card->getId()]);
            foreach ($effects as &$eff['childs']) {
              if (isset($eff['pId'])) {
                continue;
              }
              $eff['pId'] = $card->getPId();
            }
            $spellAction = FT::SEQ(FT::PAR($effects), ['action' => SPELL_CLEANUP, 'args' => ['cardId' => $card->getId(), 'event' => [
              'playCard' => true,
              'cardId' => $cardId,
              'cardType' => $card->getType(),
              'from' => $fromLocation,
              'additionalType' => $card->getAdditionalType(),
              'to' => $location,
              'playedFree' => $cost == 0 ? true : false,
              'putAndNotPlayed' => !$effectHand,
              'additionalEffects' => Globals::getAdditionalEffect(),
              'stealOwnership' => $stealOwnership,
            ]], 'pId' => $player->getId()]);
          } else {
            $spellAction = ['action' => SPELL_CLEANUP, 'args' => ['cardId' => $card->getId(), 'event' => [
              'playCard' => true,
              'cardId' => $cardId,
              'cardType' => $card->getType(),
              'additionalType' => $card->getAdditionalType(),
              'from' => $fromLocation,
              'to' => $location,
              'playedFree' => $cost == 0 ? true : false,
              'putAndNotPlayed' => !$effectHand,
              'additionalEffects' => Globals::getAdditionalEffect(),
              'stealOwnership' => $stealOwnership,
            ]], 'pId' => $player->getId()];
          }
          $this->insertAsChild($spellAction);
          $effects = [];
        }
        if (in_array(SPELL, $card->getAdditionalType())) {
          Engine::resolveAction();
        }
      } else {
        // resolving current node as some things are inserted before and after
        Engine::resolveAction();
      }

      if (Globals::getAdditionalEffect() != []) {
        $addEffects = Globals::getAdditionalEffect();
        foreach ($addEffects as $i => &$addEffect) {
          if ($addEffect['type'] == $card->getType()) {
            if ($addEffect['from'] == $fromLocation) {
              $effectType = $addEffect['effect'];
              $f = 'getEffect' . ucfirst($effectType);
              $newEffect = $card->$f();
              if (isset($addEffect['to']) && !is_null($addEffect['to'])) {
                if ($addEffect['to'] == 'sourceLocation') {
                  $source = Cards::get($addEffect['sourceId']);
                  if ($location != $source->getLocation()) {
                    continue;
                  }
                } elseif ($addEffect['to'] != $location) {
                  continue;
                }
              }
              if (!empty($newEffect)) {
                $effects[] = $newEffect;
              }
              if ($effectType == RESERVE && $player->getPlayedCards()->filter(function ($c) {
                return in_array($c->getUid(), ['ALT_CORE_B_BR_30_R', 'ALT_CORE_B_BR_30_C']);
              })->count() > 0) {
                $effects[] = FT::GAIN($card->getId(), BOOST);
              }
              if (($addEffect['boost'] ?? 0) > 0) {
                $effects[] = FT::GAIN($card->getId(), BOOST, $addEffect['boost']);
              }
              unset($addEffects[$i]);
            }
          }
        }
        Globals::setAdditionalEffect($addEffects);
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

    //  #171615: "Use of Sleight of Hand on Scribbling Starfish"
    if ($card->getType() != SPELL) {
      $this->checkImmediateListeners($player, [
        'playCard' => true,
        'cardId' => $cardId,
        'cardType' => $card->getType(),
        'additionalType' => $card->getAdditionalType(),
        'from' => $fromLocation,
        'to' => $location,
        'playedFree' => $cost == 0 ? true : false,
        'putAndNotPlayed' => !$effectHand,
        'additionalEffects' => Globals::getAdditionalEffect(),
        'token' => $card->isToken(),
        'stealOwnership' => $stealOwnership,
      ]);

      $this->checkAfterListeners($player, [
        'playCard' => true,
        'cardId' => $cardId,
        'cardType' => $card->getType(),
        'additionalType' => $card->getAdditionalType(),
        'from' => $fromLocation,
        'reallyPlayed' => $reallyPlayed,
        'locationPId' => $player->getId(),
        'to' => $location,
        'gigantic' => $card->isGigantic(),
        'playedFree' => $cost == 0 ? true : false,
        'putAndNotPlayed' => !$effectHand,
        'additionalEffects' => Globals::getAdditionalEffect(),
        'token' => $card->isToken(),
        'stealOwnership' => $stealOwnership,
      ]);
    }
    // throw new \feException(print_r(Globals::getEngine()));

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
      Globals::setRemoveFleetingCharacterPlayed(false);
    } elseif (in_array($card->getType(), [CHARACTER, TOKEN]) && Globals::getRemoveFleetingCharacterStat0Played() && $baseStat0) {
      Engine::insertAtRoot(FT::LOOSE($card->getId(), FLEETING));
      Globals::setRemoveFleetingCharacterStat0Played(false);
    } elseif ((in_array(ARTIST, $card->getSubtypes()) || in_array(SONG, $card->getSubtypes())) && Globals::getRemoveFleetingSongArtistPlayed()) {
      Engine::insertAtRoot(FT::LOOSE($card->getId(), FLEETING));
      Globals::setRemoveFleetingSongArtistPlayed(false);
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
      'additionalType' => $card->getAdditionalType(),
      'from' => RESERVE,
      'isSupport' => true,
      'token' => $card->isToken(),
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
    if (empty($skipped)) {
      Globals::setFirstPass($player->getId());
    }
    $skipped[] = $player->getId();
    Globals::setSkippedPlayers($skipped);
    Notifications::pass($player);
    $this->checkAfterListeners($player, ['pass'], true, 'EndTurn');
  }
}
