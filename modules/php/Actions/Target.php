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
    'n' => 1, // number of targets
    'statuses' => 'disabled', // does it has those statuses
    'excludeSelf' => false,
    'totalCost' => INFTY,
  ];

  public function getDescription()
  {
    $targetType = $this->getArg('targetType');
    $upTo = $this->getCtxArg('upTo') ?? false;
    $totalCost = $this->getArg('totalCost');
    $msg = '';
    if (count($targetType) == 1 && $targetType == [CHARACTER]) {
      if ($upTo) {
        if ($totalCost != INFTY) {
          $msg = clienttranslate('Target up to ${n} character(s) (of max hand cost of ${totalCost}) to ${effect_desc}');
        } else {
          $msg = clienttranslate('Target up to ${n} character(s) to ${effect_desc}');
        }
      } else {
        $msg = clienttranslate('Target ${n} character(s) to ${effect_desc}');
      }
    } elseif (count($targetType) == 1 && $targetType == [PERMANENT]) {
      if ($upTo) {
        if ($totalCost != INFTY) {
          $msg = clienttranslate('Target up to ${n} permanent(s) (of max hand cost of ${totalCost}) to ${effect_desc}');
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
        } else {
          $msg = clienttranslate('Target up to ${n} card(s) to ${effect_desc}');
        }
      } else {
        $msg = clienttranslate('Target ${n} card(s) to ${effect_desc}');
      }
    }

    return [
      'log' => $msg,
      'args' => [
        'n' => $this->getCtxArg('n') ?? 1,
        'effect_desc' => Engine::buildTree($this->getCtxArg('effect'))->getDescription(),
        'totalCost' => $totalCost,
        'i18n' => ['effect_desc'],
      ],
    ];
  }

  public function isDoable($player)
  {
    return $this->getArg('upTo') || count($this->getTargetableCards($player)) != 0;
  }

  public function isOptional()
  {
    return $this->getArg('upTo') || count($this->getTargetableCards(Players::getActive())) == 0;
  }


  public function getTargetableCards($player)
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

    // What cards ?
    $targetType = $this->getArg('targetType');
    $targetLocation = $this->getArg('targetLocation');
    $cards = Cards::getFiltered($pIds, $targetLocation, $targetType);
    $excludeSelf = $this->getArg('excludeSelf');
    $sourceId = $this->getSourceId();

    // Which criteria ?
    $cards = $cards->filter(function ($c) use ($excludeSelf, $sourceId) {
      if ($excludeSelf && $c->getId() == $sourceId) {
        return false;
      }

      $handCost = $c->getCostHand();
      $reserveCost = $c->getCostReserve();
      $statuses = $this->getArg('statuses');
      $costCheck =
        $this->getArg('minHandCost') <= $handCost &&
        $handCost <= $this->getArg('maxHandCost') &&
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
    ];
  }

  public function stTarget()
  {
    $args = $this->argsTarget();
    if ($args['upTo'] == false && count($args['cardIds']) <= $args['n']) {
      $this->actTarget($args['cardIds']);
    }
  }

  public function actTarget($cardIds)
  {
    $player = Players::getActive();
    $args = $this->argsTarget();
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

    $cards = Cards::getMany($cardIds);

    foreach ($cards as $cardId => $card) {
      $node = $this->getArg('effect');
      $node['args']['cardId'] = $cardId;
      $node['sourceId'] = $this->getSourceId();
      $this->pushParallelChild($node);
      $totalCost -= $card->getCostHand();
    }

    if ($totalCost < 0) {
      throw new \BgaUserException(clienttranslate('Total hand cost exceeds the limit of the effect'));
    }

    $cards = Cards::getMany($cardIds);
    Notifications::targetCards($player, $cards, $this->getSource());
    $this->resolveAction([$cardIds]);
  }
}
