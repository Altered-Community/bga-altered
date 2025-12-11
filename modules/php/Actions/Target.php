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
use ALT\Helpers\Conditions;

class Target extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_TARGET;
  }

  protected $args = [
    'upTo' => false, // if n > 1, can the player select UP TO n cards or exactly n cards ?
    'targetPlayer' => ALL,
    'targetType' => [CHARACTER, TOKEN], // must be an array
    'targetLocation' => IN_PLAY, //  must be an array reserve / inplay)
    'maxReserveCost' => INFTY, // limitation
    'maxHandCost' => INFTY, // limitation
    'minReserveCost' => 0, // limitation
    'minHandCost' => 0, // limitation
    'maxBaseCost' => INFTY,
    'n' => 1, // number of targets
    'statuses' => 'disabled', // does it has those statuses
    'excludedStatuses' => [],
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
    'augmentOnly' => false,
    'effect' => null,
    'allIds' => false, // we put all the Ids instead of duplicating for each card
    'ignoreTough' => false,
    'excludeToken' => false,
    'onlyToken' => false,
    'ascendedOnly' => false,
    'monoBiome' => false, // Rare Lyra Origamium
    'isNotTapped' => false,
  ];

  public function getDescription()
  {
    $targetType = $this->getArg('targetType');
    $upTo = $this->getCtxArg('upTo') ?? false;
    $totalCost = $this->getArg('totalCost');
    $totalMountain = $this->getArg('totalMountain');
    $baseCost = $this->getArg('maxBaseCost');
    $msg = '';
    if (count($targetType) == 1 && $targetType == [CHARACTER]) {
      if ($upTo) {
        if ($totalCost != INFTY) {
          $msg = clienttranslate('Target up to ${n} character(s) (of max hand cost of ${totalCost}) to ${effect_desc}');
        } elseif ($totalMountain != INFTY) {
          $msg = clienttranslate('Target up to ${n} character(s) (of max mountain attribute of ${totalMountain}) to ${effect_desc}');
        } else {
          if ($this->getArg('n') == INFTY) {
            $msg = clienttranslate('All valid characters ${effect_desc}');
          } else {
            $msg = clienttranslate('Target up to ${n} character(s) to ${effect_desc}');
          }
        }
      } else {
        $msg = clienttranslate('Target ${n} character(s) to ${effect_desc}');
      }
    } elseif (count($targetType) == 1 && $targetType == [PERMANENT]) {
      if ($upTo) {
        if ($totalCost != INFTY) {
          $msg = clienttranslate('Target up to ${n} permanent(s) (of max hand cost of ${totalCost}) to ${effect_desc}');
        } elseif ($totalMountain != INFTY) {
          $msg = clienttranslate('Target up to ${n} permanent(s) (of max mountain attribute of ${totalMountain}) to ${effect_desc}');
        } else {
          $msg = clienttranslate('Target up to ${n} permanent(s) to ${effect_desc}');
        }
      } else {
        $msg = clienttranslate('Target ${n} permanent(s) to ${effect_desc}');
      }
    } else {
      if ($upTo) {
        if ($totalCost != INFTY) {
          $msg = clienttranslate('Target up to ${n} card(s) (of max hand cost of ${totalCost}) to ${effect_desc}');
        } elseif ($totalMountain != INFTY) {
          $msg = clienttranslate('Target up to ${n} card(s) (of max mountain attribute of ${totalMountain}) to ${effect_desc}');
        } elseif ($baseCost != INFTY) {
          $msg = clienttranslate('Target up to ${n} card(s) (of max base cost of ${baseCost}) to ${effect_desc}');
        } else {
          if ($this->getArg('n') == INFTY) {
            $msg = clienttranslate('All valid targets ${effect_desc}');
          } else {
            $msg = clienttranslate('Target up to ${n} card(s) to ${effect_desc}');
          }
        }
      } else {
        if ($this->getArg('n') == INFTY) {
          $msg = clienttranslate('All valid targets ${effect_desc}');
        } elseif ($baseCost != INFTY) {
          $msg = clienttranslate('Target ${n} card(s) (of max base cost of ${baseCost}) to ${effect_desc}');
        } else {
          $msg = clienttranslate('Target ${n} card(s) to ${effect_desc}');
        }
      }
    }

    return [
      'log' => $msg,
      'args' => [
        'n' => $this->getCtxArg('n') ?? 1,
        'effect_desc' => Engine::buildTree($this->getCtxArg('effect'))->getDescription(),
        'totalCost' => $totalCost,
        'totalMountain' => $totalMountain,
        'baseCost' => $baseCost,
        'i18n' => ['effect_desc'],
      ],
    ];
  }

  public function isDoable($player)
  {
    $targetCards = $this->getTargetableCards($player);
    if ($this->getArg('allIds')) {
      // check if we have cards to pay and not enough mana
      $targetCosts = $this->getTargetCosts($player);
      $totalCost = 0;

      if ((count($targetCards) - count($targetCosts)) <= 2) {
        $costs = array_values($targetCosts);
        asort($costs);
        $valuesToGet = count($targetCards) - count($targetCosts) - 1;
        for ($i = 0; $i < $valuesToGet; $i++) {
          $totalCost += ($costs[$i] ?? 0);
        }
      }
      if ($totalCost > $player->getMana()) {
        return false;
      }
    }
    return $this->getArg('upTo') ||
      (!$this->getArg('allIds') && count($targetCards) != 0) ||
      ($this->getArg('allIds') && count($targetCards) >= $this->getArg('n'));
  }

  public function isOptional($player)
  {

    return $this->getArg('upTo') ||
      count($this->getTargetableCards(Players::getActive(), true)) == 0 ||
      !$this->isDoable($player) ||
      $this->getCtx()->getOptional();
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

    $maxHandCost = $this->getArg('maxHandCost');
    if (!is_int($maxHandCost) && $maxHandCost == 'controlledCharacter') {
      $maxHandCost = $player->getPlayedCards(CHARACTER)->count() + $player->getPlayedCards(TOKEN)->count();
    } elseif (!is_int($maxHandCost) && $maxHandCost == 'maxCharacter') {
      $maxHandCost = -1;
      foreach ($player->getPlayedCards(CHARACTER) as $cId => $cardSearch) {
        $maxHandCost = max($maxHandCost, $cardSearch->getCostHand());
      }
    } elseif (!is_int($maxHandCost) && $maxHandCost == 'sourceCounter2') {
      $maxHandCost = ($this->getSource()->getExtraDatas()['counter'] ?? 0) + 2;
    } elseif (!is_int($maxHandCost) && $maxHandCost == 'discard2') {
      $previousCardId = $this->getCtxArg('cardId');
      if (is_null($previousCardId)) {
        $maxHandCost = 2;
      } else {
        $maxHandCost = 2 + Cards::get($previousCardId)->getCostHand();
      }
    }

    // What cards ?
    $targetType = $this->getArg('targetType');
    $targetLocation = $this->getArg('targetLocation');
    if ($targetLocation == ['source']) {
      $targetLocation = [$this->getSource()->getLocation()];
      if (Cards::get($this->getSourceId())->isGigantic()) {
        $targetLocation = STORMS;
      }
    } elseif ($targetLocation == ['oppositeSource']) {
      $targetLocation = [$this->getSource()->getLocation() == STORM_RIGHT ? STORM_LEFT : STORM_RIGHT];
      if (Cards::get($this->getSourceId())->isGigantic()) {
        $targetLocation = STORMS;
      }
    } elseif ($targetLocation == ['opponentSource']) {
      $targetLocation = [$this->getSource()->getLocation()];
      if (Cards::get($this->getSourceId())->isGigantic()) {
        $targetLocation = STORMS;
      }
      $targetPlayer = $pIds = array_diff($pIds, [$pId]);
    }
    $excludeTokens = $this->getArg('excludeToken');
    $onlyTokens = $this->getArg('onlyToken');
    $ascendedOnly = $this->getArg('ascendedOnly');

    if (!empty($this->getArg('cards'))) {
      $cards = Cards::getMany($this->getArg('cards'))->filter(function ($c) use ($targetLocation, $targetType) {
        return (in_array($c->getLocation(), $targetLocation) || (in_array($targetLocation, STORMS) && $c->isGigantic()))  && (in_array($c->getType(), $targetType) || count(array_intersect($targetType, $c->getAdditionalType())) > 0);
      });
    } else {
      $cards = Cards::getFiltered($pIds, null, $targetType, true)->filter(function ($c) use ($targetLocation, $targetType, $excludeTokens, $onlyTokens) {
        return ((in_array($c->getLocation(), $targetLocation)
          || ((in_array(STORM_LEFT, $targetLocation) || in_array(STORM_RIGHT, $targetLocation)) && in_array($c->getLocation(), STORMS) && $c->isGigantic()))
          || ($c->getType() == HERO && in_array(HERO, $targetType))) &&
          // Token exclusion
          ($excludeTokens === false  || ($excludeTokens === true && !$c->isToken())) &&
          ($onlyTokens == false || ($onlyTokens === true && $c->isToken()));
      });
    }

    $excludeSelf = $this->getArg('excludeSelf');
    $sourceId = $this->getSourceId();
    $subType = $this->getArg('subType');
    $expeditionAttributes = $this->getArg('expeditionAttributes');
    $filteredBiomes = Players::filterBiomes($expeditionAttributes);
    $excludedBiomes = $this->getArg('excludeBiomes') ? Players::excludeBiomes($expeditionAttributes) : null;
    $isTapped = $this->getArg('isTapped');
    $isNotTapped = $this->getArg('isNotTapped');
    $maxStatistic = $this->getArg('maxStatistic');

    $augmentOnly = $this->getArg('augmentOnly');
    $monoBiome = $this->getArg('monoBiome');

    // Duster
    $maxBaseCost = $this->getArg('maxBaseCost');

    // Which criteria ?
    $cards = $cards->filter(function ($c) use ($excludeSelf, $sourceId, $maxHandCost, $subType, $player, $checkTough, $filteredBiomes, $excludedBiomes, $isTapped, $maxStatistic, $augmentOnly, $ascendedOnly, $monoBiome, $maxBaseCost, $isNotTapped) {
      if ($excludeSelf && $c->getId() == $sourceId) {
        return false;
      }
      $otherLocation = in_array($c->getLocation(), STORMS) ? ($c->getLocation() == STORM_LEFT ? STORM_RIGHT : STORM_LEFT) : null;
      // if we need to filter by location & attributes 
      if ($excludedBiomes === null && in_array($c->getLocation(), STORMS) && !in_array($c->getLocation(), $filteredBiomes[$c->getPId()]) && !$c->isGigantic()) {
        return false;
      }
      if ($excludedBiomes === null && $c->isGigantic() && in_array($c->getLocation(), STORMS) && !in_array($otherLocation, $filteredBiomes[$c->getPId()]) && !in_array($c->getLocation(), $filteredBiomes[$c->getPId()])) {
        return false;
      }
      if ($excludedBiomes !== null && in_array($c->getLocation(), STORMS) && !in_array($c->getLocation(), ($excludedBiomes[$c->getPId()] ?? [])) && $c->isGigantic()) {
        return false;
      }
      if ($isTapped && !$c->isTapped()) {
        return false;
      }

      if ($isNotTapped && $c->isTapped()) {
        return false;
      }

      // Only card with a boost or a counter can be augmented
      if ($augmentOnly && !$c->hasCounters()) {
        return false;
      }

      if ($ascendedOnly && !$c->isInAscended()) {
        return false;
      }

      if ($monoBiome && !Conditions::cardInMonoRegion($c, [])) {
        return false;
      }

      $handCost = $c->getCostHand();
      $reserveCost = $c->getCostReserve();
      $statuses = $this->getArg('statuses');
      $excludedStatuses = $this->getArg('excludedStatuses');
      $effects = $this->getArg('hasEffects');
      if ($effects != 'disabled') {
        $found = false;
        foreach ($effects as $effect) {
          $f = 'getEffect' . $effect;
          if (!empty($c->$f())) {
            $found = true;
          }
        }
        if (!$found) {
          return false;
        }
      }

      if ($subType != 'disabled' && !in_array($subType, $c->getSubtypes())) {
        return false;
      }

      if ($checkTough && $c->getPId() != $player->getId() && $c->getTough() > $player->getMana()) {
        return false;
      }

      $biomes = $c->getBiomes(true);
      foreach ($biomes as $b => $value) {
        if ($value > $maxStatistic) {
          return false;
        }
      }

      foreach ($excludedStatuses as $statusExcluded) {
        if ($c->hasToken($statusExcluded)) {
          return false;
        }
      }

      $costCheck =
        $this->getArg('minHandCost') <= $handCost &&
        $handCost <= $maxHandCost &&
        $this->getArg('minReserveCost') <= $reserveCost &&
        $reserveCost <= $this->getArg('maxReserveCost') &&
        (($c->hasToken(FLEETING) && $reserveCost <= $maxBaseCost) || (!$c->hasToken(FLEETING) && $handCost <= $maxBaseCost));

      if ($statuses == 'disabled' || $c->getType() == PERMANENT) {
        return $costCheck;
      } else {
        return $costCheck && $c->hasToken($statuses);
      }
    });
    return $cards;
  }

  public function getTargetCosts($player)
  {
    $cards = $this->getTargetableCards($player);
    $costs = [];

    if ($this->getArg('ignoreTough') == true) {
      return $costs;
    }

    foreach ($cards as $cId => $card) {
      if ($card->getTough() > 0 && $card->getPId() != $player->getId()) {
        $costs[$cId] = $card->getTough();
      }
    }
    return $costs;
  }

  public function argsTarget()
  {
    $player = Players::getActive();
    $cards = $this->getTargetableCards($player);

    return [
      'n' => $this->getArg('n'),
      'cardIds' => $cards->getIds(),
      'upTo' => $this->getArg('upTo'),
      'description' => $this->getDescription(),
      'totalCost' => $this->getArg('totalCost'),
      'totalMountain' => $this->getArg('totalMountain'),
      'targetCosts' => $this->getTargetCosts($player),
      'manaOrbs' => $this->getArg('targetLocation') == [MANA],
    ];
  }

  public function stTarget()
  {
    $args = $this->argsTarget();
    if ($args['upTo'] == false && !$this->isOptional(Players::getActive()) && count($args['cardIds']) <= $args['n']) {
      $this->actTarget($args['cardIds']);
    }
  }

  public function actTarget($cardIds)
  {
    $player = Players::getActive();
    $args = $this->argsTarget();
    $totalCost = $this->getArg('totalCost');
    $totalMountain = $this->getArg('totalMountain');

    if (!empty(array_diff($cardIds, $args['cardIds']))) {
      throw new \BgaVisibleSystemException('You cannot target these cards. Should not happen');
    }
    if (count($cardIds) > $args['n']) {
      throw new \BgaVisibleSystemException('You selected too many cards. Should not happen');
    }
    if (
      !$args['upTo'] &&
      ((count($args['cardIds']) >= $args['n'] && count($cardIds) < $args['n']) ||
        (count($args['cardIds']) < $args['n'] && count($cardIds) != count($args['cardIds'])))
    ) {
      throw new \BgaVisibleSystemException('You havent selected enough cards. Should not happen');
    }

    // Tough
    $additionalCost = 0;
    foreach ($cardIds as $cardId) {
      $additionalCost += $args['targetCosts'][$cardId] ?? 0;
    }
    if ($additionalCost > $player->getMana()) {
      throw new \BgaUserException(clienttranslate('You cannot pay the additional cost (Tough effect)'));
    }
    $player->payMana($additionalCost);
    list($excludeIncreaseCard, $increaseOther) = $player->hasIncreaseAllOtherCharactersBiomesHighest();

    $cards = Cards::getMany($cardIds);
    $source = $this->getSource();
    if ($this->getArg('allIds') === true) {
      $node = $this->getArg('effect');
      if (!is_null($node)) {
        $node = $this->updateCardId($node, $cardIds, '', $this->getSourceId(), $player->getId());
        $this->pushParallelChild($node);
      }
      $cards = Cards::getMany($cardIds);
      Notifications::targetCards($player, $cards, $additionalCost, $this->getSource());
    } else {
      foreach ($cards as $cardId => $card) {
        $cardFrom = $card->getLocation();

        // Select untapped card in mana => untap another card if any
        if ($args['manaOrbs'] && !$card->isTapped()) {
          $card2 = $player->getManaCards(true)->first();
          if (!is_null($card2)) {
            $card2->setTapped(false);
          }
        }

        $node = $this->getArg('effect');

        if (!is_null($node)) {
          $node = $this->updateCardId($node, $cardId, $cardFrom, $this->getSourceId(), $card->getPlayer()->getId());
          if (in_array($cardFrom, [STORM_LEFT, STORM_RIGHT])) {  // in case of invoking token combined with a sacrifice
            $node = Utils::updateTree($node, [0 => 'source'], [$cardFrom], ['targetLocation']);
            $node = Utils::updateTree($node, [0 => 'oppositeSource'], [$source->getLocation() == STORM_LEFT ? STORM_RIGHT : STORM_LEFT], ['targetLocation']);
            $discardSource = $cardFrom . '-' . $card->getPId();
            $node = Utils::updateTree($node, [0 => 'discardedSource'], [$discardSource], ['targetLocation']);
            // if the discarded card is the source, need to update the location
            if ($cardId == $this->getSourceId() && in_array($card->getUid(), ['ALT_CORE_B_OR_06_U_3184', 'ALT_COREKS_B_AX_07_U_5235', 'ALT_CORE_B_OR_06_U_3184', 'ALT_COREKS_B_OR_17_U_1949'])) {
              $node = Utils::updateTree($node, [0 => 'initialSource'], [$discardSource], ['targetLocation']);
            }
          }

          $this->pushParallelChild($node);
        }
        $totalCost -= $card->getCostHand();
        $giganticIncrease = false;
        if (
          $card->getPlayer()->hasIncreaseBiomesHighest($card->getLocation()) ||
          ($card->isGigantic() && $card->getPlayer()->hasIncreaseBiomesHighest($card->getLocation() == STORM_LEFT ? STORM_RIGHT : STORM_LEFT))
        ) {
          $giganticIncrease = true;
        }

        $increaseBiome = $giganticIncrease || $increaseOther;
        if ($excludeIncreaseCard == $cardId) {
          $increaseBiome = $giganticIncrease;
        }

        $biomes = $card->getBiomes(true,  $increaseBiome);
        $totalMountain -= $biomes[MOUNTAIN];
      }

      if ($totalCost < 0) {
        throw new \BgaUserException(clienttranslate('Total hand cost exceeds the limit of the effect'));
      }
      if ($totalMountain < 0) {
        throw new \BgaUserException(clienttranslate('Total mountain attribute exceeds the limit of the effect'));
      }

      $cards = Cards::getMany($cardIds);
      Notifications::targetCards($player, $cards, $additionalCost, $this->getSource());

      if ($this->getArg('discardRemaining') == true) {
        foreach (array_diff($this->getArg('cards'), $cardIds) as $cId) {
          Cards::discard($cId);
        }

        Notifications::publicDiscard(
          $player,
          Cards::getMany(array_diff($this->getArg('cards'), $cardIds)),
          clienttranslate('${player_name} discards ${card_names} as they are not targeted'),
          [
            'source' => HAND,
            'hand' => true,
            'destination' => DISCARD,
          ]
        );
      }
    }

    $this->resolveAction([$cardIds]);
  }
}
