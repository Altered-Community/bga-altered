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

  // !!!!!!!!!!!!!! Target must have a brother

  public function getDescription()
  {
    // TODO: manage the next nodes
    $targetType = $this->getCtxArg('targetType') ?? [EXPLORER];

    if (count($targetType) == 1 && $targetType == EXPLORER) {
      return clienttranslate('Target a character');
    } elseif (count($targetType) == 1 && $targetType == PERMANENT) {
      return clienttranslate('Target a permanent');
    } else {
      return clienttranslate('Target a card');
    }
  }

  public function stTarget()
  {
    // TODO: if nothing to target, autopass the whole seq node
  }

  public function argsTarget()
  {
    $player = Players::getCurrent();
    // targetType : must be an array
    // targetLocation : must be an array reserve / inplay)
    // targetPlayer (all/opponent/me)
    // MemoryCost limitation
    // HandCost limitation
    // costCompare : to take more or less thatn the cost
    // n
    // optional?

    $targetPlayer = $this->getCtxArg('targetPlayer') ?? ALL;
    $targetType = $this->getCtxArg('targetType') ?? [EXPLORER];
    $targetLocation = $this->getCtxArg('targetLocation') ?? ['played'];
    $memoryCost = $this->getCtxArg('memoryCost') ?? 99;
    $handCost = $this->getCtxArg('handCost') ?? 99;
    $costCompare = $this->getCtxArg('costCompare') ?? '<';

    $cards = new Collection();

    foreach (Players::getAll() as $pId => $playerT) {
      // if we must take only the opponents
      if ($targetPlayer == OPPONENT && $pId == $player->getId()) {
        continue;
      }
      if ($targetPlayer == ME && $pId != $player->getId()) {
        continue;
      }
      foreach ($targetLocation as $loc) {
        $fnCard = 'get' . ucfirst($loc) . 'Cards';
        foreach ($targetType as $type) {
          $cards = $cards->merge($playerT->$fnCard($type));
        }
      }
    }

    $cards = $cards->filter(function ($c) use ($handCost, $memoryCost, $costCompare) {
      return version_compare($c->getCostHand(), $handCost, $costCompare) &&
        version_compare($c->getCostMemory(), $memoryCost, $costCompare);
    });

    return [
      'total' => $this->getCtxArg('total') ?? 1,
      'n' => $this->getCtxArg('n') ?? 1,
      'cards' => $cards->getIds(),
      'canPass' => $this->getCtxArg('optional') ?? false,
    ];
  }

  public function actTarget($cardIds)
  {
    self::checkAction('actTarget');
    $player = Players::getActive();
    $args = $this->argsTarget();

    if (!empty(array_diff($cardIds, $args['cards']))) {
      throw new \BgaVisibleSystemException('You cannot target this card. Should not happen');
    }

    if (count($cardIds) > $args['n']) {
      throw new \BgaVisibleSystemException('You selected too many cards. Should not happen');
    }

    if (!$args['canPass'] && count($args['cards']) < $args['n'] && count($cardIds) != count($args['cards'])) {
      throw new \BgaVisibleSystemException('You selected not enough cards. Should not happen');
    } elseif (!$args['canPass'] && count($cardIds) < $args['n']) {
      throw new \BgaVisibleSystemException('You selected not enough cards. Should not happen');
    }

    $brotherArgs = [];
    foreach ($cardIds as $cardId) {
      $brotherArgs[] = ['cardId' => $cardId];
    }
    Engine::updateBrotherArgs($brotherArgs);

    Notifications::message('targeted');
    $this->resolveAction([$cardIds]);
  }

  public function actTargetPass()
  {
    self::checkAction('actTarget');
    $player = Players::getActive();
    if (($this->getCtxArg('optional') ?? 'toto') !== true) {
      throw new \BgaVisibleSystemException('This action cannot be passed.Should not happen');
    }
    // TODO: how to exclude after nodes
    // TODO: Change intimidation
    $this->resolveAction([PASS]);
  }
}
