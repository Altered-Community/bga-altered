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
    $actions = ['hand' => [], 'memory' => [], 'echo' => [], 'hero' => [], 'permanent' => []];

    // calculate
    // 1. hand cards
    $actions['hand'] = $handCards->filter(function ($card) use ($player) {
      return $card->canBePlayed($player);
    });

    // 2. Memory cards (callback effect)
    $actions['memory'] = $memoryCards->filter(function ($card) use ($player) {
      return $card->canBePlayed($player);
    });

    // 3. Echo
    $action['echo'] = $memoryCards->filter(function ($card) {
      return !is_null($card->getEffectEcho());
    });

    // 4. Permanent/tap effect
    // $action['hero'] = !$player
    //   ->getHero()
    //   ->first()
    //   ->isTapped()
    //   ? $player->getHero()
    //   : null;
    $actions['permanent'] = $player->getPermanents()->filter(function ($card) {
      return !$card->isTapped() && true; // permanentEffect TODO
    });

    return ['_private' => ['active' => $actions]];
  }

  public function actHand($cardId, $to = null)
  {
    self::checkAction('actHand');
    $player = Players::getActive();
    $args = $this->argsChooseAssignment()['_private']['active']['hand'];
    if (!in_array($to, STORMS)) {
      throw new \BgaVisibleSystemException('Invalid location to play a card. Should not happen');
    }
    if (!isset($args[$cardId])) {
      throw new \BgaVisibleSystemException('This card cannot be played. Should not happen');
    }

    $this->playCardInStorm($cardId, HAND, $to);
  }

  public function actMemory($cardId, $to = null)
  {
    self::checkAction('actMemory');
    $player = Players::getActive();
    $args = $this->argsChooseAssignment()['_private']['active']['memory'];
    if (!in_array($to, STORMS)) {
      throw new \BgaVisibleSystemException('Invalid location to play a card. Should not happen');
    }
    if (!isset($args[$cardId])) {
      throw new \BgaVisibleSystemException('This card cannot be played. Should not happen');
    }

    $this->playCardInStorm($cardId, MEMORY, $to);
  }

  public function playCardInStorm($cardId, $location, $to = null)
  {
    $player = Players::getActive();
    $card = Cards::get($cardId);
    if ($card->getPId() != $player->getId()) {
      throw new \BgaVisibleSystemException('You do not own this card. Should not happen');
    }

    if ($card->getLocation() != $location) {
      throw new \BgaVisibleSystemException('Location of the card is not ok. Should not happen');
    }

    // Pay cost
    $cost = $card->getCost();
    $player->pay($cost);
    // left or right storm
    $card->setLocation($to);

    // notification
    Notifications::playCard($player, $card, $cost, $location, $to);

    // if played from memory, it gains fleeting
    if ($location == MEMORY) {
      $card->setProperty(FLEETING, true);
      Notifications::gainToken(FLEETING, $card);
    }

    // insert linked flow
    $effect = 'getEffect' . ucfirst($location);
    // $this->pushParallelChilds($card->$effect());
    $this->resolveAction([$cardId, $to]);
  }

  public function actEcho($cardId)
  {
    // echo management
  }

  // public function actChooseActionCard($cardId, $strength)
  // {
  //   self::checkAction('actChooseActionCard');
  //   $player = Players::getActive();
  //   $args = $this->argsChooseActionCard();
  //   $isHypnosis = $this->isHypnosis();

  //   if (!isset($args['cards'][$cardId])) {
  //     throw new \BgaVisibleSystemException('Card action not doable. Should not happen');
  //   }
  //   if (!array_key_exists($strength, $args['cards'][$cardId])) {
  //     throw new \BgaVisibleSystemException('You cannot play that card at that strength. Should not happen');
  //   }

  //   // Activate the card
  //   $card = ActionCards::get($cardId);
  //   $card->setStatus(1);
  //   if ($isHypnosis) {
  //     Globals::setEffectHypnosis($cardId);
  //   }
  //   Globals::setVenomTriggered(true);

  //   // if Strength = 0, gain XToken
  //   if ($strength == 0) {
  //     // TODO: if multiplier must take XToken again if previously used
  //     $meeples = [];
  //     if ($player->countXTokens() >= 5) {
  //       throw new \BgaVisibleSystemException('You cannot earn more Xtoken. Should not happen');
  //     }
  //     $player->incXToken(1);
  //     Stats::incXTokenGainedInsteadOfAction($player, 1);
  //   }
  //   // Otherwise, pay tokens if Needed
  //   else {
  //     $tokens = $args['cards'][$cardId][$strength];
  //     if ($tokens > 0) {
  //       $player->payXToken($tokens, true, clienttranslate('increasing card strength'));
  //     }

  //     // Notify
  //     Notifications::chooseCard($player, $card, $strength, $tokens);

  //     // Do action
  //     $flow = $card->getTaggedFlow($player, $strength);
  //     $this->insertAsChild($flow);

  //     $methodName = 'incAction' . $card->getName();
  //     Stats::$methodName($player);
  //   }

  //   // VENOM : if the card has a Venom token, tag it as used (for cleanup purpose)
  //   if (!$isHypnosis && count($card->getMeeplesOnIt(VENOM)) > 0) {
  //     Globals::setUsedVenom(true);
  //   }

  //   // USE MULTIPLIER
  //   if ($this->isMultiplier()) {
  //     $meepleId = $this->getCtxArg('meepleId');
  //     $meeple = Meeples::destroy($meepleId);
  //     Notifications::useMultiplier($player, $meeple);
  //     $this->resolveAction(['card' => $cardId, 'strength' => $strength]);
  //     return;
  //   }

  //   // DUPLICATE ACTION IF THERE ARE MULTIPLIERS
  //   $multipliers = $card->getMeeplesOnIt(MULTIPLIER, ACTIVE);
  //   if (!$isHypnosis && $multipliers->count() > 0) {
  //     foreach ($multipliers as $meeple) {
  //       $this->insertAsChild([
  //         'action' => CHOOSE_ACTION_CARD,
  //         'pId' => $player->getId(),
  //         'args' => ['cardId' => $card->getId(), 'strength' => $strength, 'multiplier' => true, 'meepleId' => $meeple['id']],
  //       ]);
  //     }
  //   }

  //   // Insert cleanup actionName
  //   $this->insertAsChild([
  //     'action' => \CLEANUP,
  //     'pId' => $player->getId(),
  //     'args' => ['card' => $cardId, 'hypnosis' => $isHypnosis],
  //   ]);
  //   $this->resolveAction(['card' => $cardId, 'strength' => $strength]);
  // }
}
