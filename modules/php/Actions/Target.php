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
  // !!!!!!!!!!!!!! 2 targets must be in 2 different seq nodes

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
      'n' => $this->getCtxArg('n'),
      'cards' => $cards->getIds(),
    ];
  }

  public function actTarget($cardId)
  {
    self::checkAction('actTarget');
    $player = Players::getActive();
    $args = $this->argsTarget();

    if (!in_array($cardId, $args['cards'])) {
      throw new \BgaVisibleSystemException('You cannot target this card. Should not happen');
    }

    Engine::updateBrotherArgs(['cardId' => $cardId]);

    Notifications::message('targeted');
    $this->resolveAction([$cardId]);
  }
}
