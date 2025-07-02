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
use ALT\Helpers\FT;
use ALT\Models\Player;

class DiscardDo extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_DISCARD_DO;
  }

  public function getDescription()
  {

    return [
      'log' => clienttranslate('Discard any number of cards from your reserve to ${effect_desc}'),
      'args' => [
        'effect_desc' => Engine::buildTree($this->getCtxArg('effect'))->getDescription(),
      ]
    ];
  }

  protected $args = [
    'upTo' => true, // if n > 1, can the player select UP TO n cards or exactly n cards ?
    'targetPlayer' => ME,
    'targetType' => [CHARACTER, TOKEN, SPELL, PERMANENT], // must be an array
    'targetLocation' => [RESERVE], //  must be an array reserve / inplay)
    'maxReserveCost' => INFTY, // limitation
    'maxHandCost' => INFTY, // limitation
    'minReserveCost' => 0, // limitation
    'minHandCost' => 0, // limitation
    'n' => 99, // number of targets
    'statuses' => 'disabled', // does it has those statuses
    'excludeSelf' => false,
    'totalCost' => INFTY,
    'hasEffects' => 'disabled',
    'cards' => [],
    'discardRemaining' => false,
    'subType' => 'disabled',
    'effect' => null,
    'sacrifice' => false,
  ];

  public function isOptional($player)
  {
    return true;
  }

  public function getTargetableCards($player)
  {
    // Who is the target ?
    $pId = $player->getId();
    $pIds = [$pId];
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
    }

    // What cards ?
    $targetType = $this->getArg('targetType');
    $targetLocation = $this->getArg('targetLocation');
    if ($targetLocation == ['source']) {
      $targetLocation = [$this->getSource()->getLocation()];
    } elseif ($targetLocation == ['opposite']) {
      $targetLocation = [$this->getSource()->getLocation() == STORM_RIGHT ? STORM_LEFT : STORM_RIGHT];
    }

    if (!empty($this->getArg('cards'))) {
      $cards = Cards::getMany($this->getArg('cards'))->filter(function ($c) use ($targetLocation, $targetType) {
        return in_array($c->getLocation(), $targetLocation) && in_array($c->getType(), $targetType);
      });
    } else {
      $cards = Cards::getFiltered($pIds, $targetLocation, $targetType);
    }

    $excludeSelf = $this->getArg('excludeSelf');
    $sourceId = $this->getSourceId();
    $subType = $this->getArg('subType');

    // Which criteria ?
    $cards = $cards->filter(function ($c) use ($excludeSelf, $sourceId, $maxHandCost, $subType) {
      if ($excludeSelf && $c->getId() == $sourceId) {
        return false;
      }

      $handCost = $c->getCostHand();
      $reserveCost = $c->getCostReserve();
      $statuses = $this->getArg('statuses');
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

      $costCheck =
        $this->getArg('minHandCost') <= $handCost &&
        $handCost <= $maxHandCost &&
        $this->getArg('minReserveCost') <= $reserveCost &&
        $reserveCost <= $this->getArg('maxReserveCost');

      if ($statuses == 'disabled' || $c->getType() == PERMANENT) {
        return $costCheck;
      } else {
        return $costCheck && $c->hasToken($statuses);
      }
    });

    return $cards;
  }

  public function argsDiscardDo()
  {
    $player = Players::getActive();
    $cards = $this->getTargetableCards($player);

    return [
      'n' => $this->getArg('n'),
      'cardIds' => $cards->getIds(),
      'upTo' => $this->getArg('upTo'),
      'description' => $this->getDescription(),
      'totalCost' => $this->getArg('totalCost'),
      'manaOrbs' => $this->getArg('targetLocation') == [MANA],
      'targetCosts' => [],
      'effect_desc' => Engine::buildTree($this->getCtxArg('effect'))->getDescription(),
    ];
  }

  public function actTarget($cardIds)
  {
    $player = Players::getActive();
    $args = $this->argsDiscardDo();
    $totalCost = $this->getArg('totalCost');

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

    $isSacrifice = $this->getArg('sacrifice');
    $cards = Cards::getMany($cardIds);
    $nodes = [];
    foreach ($cardIds as $cId) {
      if ($isSacrifice) {
        $nodes[] = FT::ACTION(DISCARD, ['cardId' => $cId, 'desc' => 'sacrifice'], ['sourceId' => $this->getSourceId()]);
      } else {
        $nodes[] = FT::ACTION(DISCARD, ['cardId' => $cId], ['sourceId' => $this->getSourceId()]);
      }
    }
    $effect = $this->getArg('effect');
    $effect['args']['n'] = count($cardIds);
    $effect['sourceId'] = $this->getSourceId();

    $this->insertAsChild(
      FT::SEQ(
        FT::SEQ(...$nodes),
        $effect
        // FT::ACTION(DRAW, ['players' => ME, 'n' => count($cardIds)], ['sourceId' => $this->getSourceId()])
      )
    );

    return [$cardIds];
  }
}
