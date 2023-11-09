<?php
namespace ALT\Actions;
use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Engine;
use ALT\Core\Globals;
use ALT\Helpers\Utils;

class ActivateCard extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_ACTIVATE_CARD;
  }

  public function getCard()
  {
    return Cards::get($this->getCtxArg('cardId'));
  }

  public function getFlow($player)
  {
    return $this->getCard()->isPlayed() ||
      in_array($this->getCtxArg('cardId'), $this->getCtxArgs()['event']['cardsToListen'] ?? [])
      ? Cards::applyEffect(
        $this->getCard(),
        $player,
        $this->getCtxArgs()['event']['method'],
        $this->getCtxArgs()['event'],
        true // Throw error if no such listener
      )
      : null;
  }

  public function getFlowTree($player)
  {
    $flow = $this->getFlow($player);
    return is_null($flow) ? null : Engine::buildTree($flow);
  }

  public function isOptional()
  {
    $player = $this->getPlayer();
    if (is_null($this->getFlowTree($player))) {
      return true;
    }
    return $this->getFlowTree($player)->isOptional();
  }

  public function isAutomatic($player = null)
  {
    return true;
  }

  public function isDoable($player)
  {
    $flowTree = $this->getFlowTree($player);
    // throw new \feException(print_r($flowTree));
    return is_null($flowTree) ? false : $flowTree->isDoable($player);
  }

  public function isIrreversible($player = null)
  {
    $flowTree = $this->getFlowTree($player);
    return is_null($flowTree) ? false : $flowTree->isIrreversible();
  }

  public function isIndependent($player = null)
  {
    $flowTree = $this->getFlowTree($player);
    return is_null($flowTree) ? false : $flowTree->isIndependent($player);
  }

  public function getDescription()
  {
    $flowTree = $this->getFlowTree($this->getPlayer());
    if (is_null($flowTree)) {
      return '';
    }

    $flowDesc = $flowTree->getDescription();
    return [
      'log' => '${flowDesc} (${source})',
      'args' => [
        'i18n' => ['flowDesc', 'source'],
        'flowDesc' => $flowDesc,
        'source' => $this->getCard()->getName(),
      ],
    ];
  }

  public function stActivateCard()
  {
    $player = $this->getPlayer();
    $node = $this->ctx;
    $flow = $this->getFlow($player);
    if ($node->isMandatory()) {
      $flow['optional'] = false; // Remove optional to avoid double confirmation UX
    }
    // Add tag about that card
    $flow = Utils::tagTree($flow, [
      'sourceId' => $this->getCtxArg('cardId'),
      'event' => $this->getCtxArg('event'),
    ]);

    $node->replace(Engine::buildTree($flow));
    Engine::save();
    Engine::proceed();
  }
}
