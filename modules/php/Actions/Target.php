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

  public function getDescription()
  {
    $targetType = $this->getArg('targetType');

    if (count($targetType) == 1 && $targetType == CHARACTER) {
      return clienttranslate('Target a character');
    } elseif (count($targetType) == 1 && $targetType == PERMANENT) {
      return clienttranslate('Target a permanent');
    } else {
      return clienttranslate('Target a card');
    }
  }

  public function isDoable($player)
  {
    return !empty($this->getTargetableCards($player));
  }

  protected $args = [
    'upTo' => false, // if n > 1, can the player select UP TO n cards or exactly n cards ?
    'targetPlayer' => ALL,
    'targetType' => [CHARACTER], // must be an array
    'targetLocation' => IN_PLAY, //  must be an array reserve / inplay)
    'maxMemoryCost' => INFTY, // limitation
    'maxHandCost' => INFTY, // limitation
    'minMemoryCost' => 0, // limitation
    'minHandCost' => 0, // limitation
    'n' => 1, // number of targets
  ];

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

    // Which criteria ?
    $cards = $cards->filter(function ($c) {
      $handCost = $c->getCostHand();
      $memoryCost = $c->getCostMemory();

      return $this->getArg('minHandCost') <= $handCost &&
        $handCost <= $this->getArg('maxHandCost') &&
        $this->getArg('minMemoryCost') <= $memoryCost &&
        $memoryCost <= $this->getArg('maxMemoryCost');
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

    foreach ($cardIds as $cardId) {
      $node = $this->getArg('effect');
      $node['args']['cardId'] = $cardId;
      $node['sourceId'] = $this->getSourceId();
      $this->pushParallelChild($node);
    }

    $cards = Cards::getMany($cardIds);
    Notifications::targetCards($player, $cards, $this->getSource());
  }
}
