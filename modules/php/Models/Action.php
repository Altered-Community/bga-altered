<?php

namespace ALT\Models;

use ALT\Core\Engine;
use ALT\Core\Game;
use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Managers\Cards;
use ALT\Managers\Players;
use ALT\Helpers\Log;
use ALT\Helpers\FlowConvertor;

/*
 * Action: base class to handle atomic action
 */

class Action
{
  protected $ctx = null; // Contain ctx information : current node of flow tree
  protected $description = '';
  public function __construct(&$ctx)
  {
    $this->ctx = &$ctx;
  }

  public function isDoable($player)
  {
    return true;
  }

  public function isOptional($player)
  {
    return false;
  }

  public function isIndependent($player = null)
  {
    return false;
  }

  public function isAutomatic($player = null)
  {
    return false;
  }

  public function isIrreversible($player = null)
  {
    return false;
  }

  public function isMandatory()
  {
    return false;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function getPlayer()
  {
    $pId = $this->ctx->getPId() ?? Players::getActiveId();
    return Players::get($pId);
  }

  public function getState()
  {
    return null;
  }

  /**
   * Syntaxic sugar
   */
  public function &getCtx()
  {
    return $this->ctx;
  }

  public function getCtxArgs()
  {
    if ($this->ctx == null) {
      return [];
    } elseif (is_array($this->ctx)) {
      return $this->ctx;
    } else {
      return $this->ctx->getArgs() ?? [];
    }
  }
  public function getCtxArg($v)
  {
    return $this->getCtxArgs()[$v] ?? null;
  }

  protected $args = []; // Contain default expected value for args
  public function getArg($v)
  {
    $t = $this->getCtxArg($v) ?? null;
    if (is_null($t)) {
      if (array_key_exists($v, $this->args)) {
        $t = $this->args[$v];
      } else {
        throw new \BgaVisibleSystemException('Trying to get value of an undefined arg without any default value : ' . $v . ' action' . $this->getClassName());
      }
    }
    return $t;
  }

  public function getEvent()
  {
    return $this->ctx->getEvent();
  }

  public function getEventRecursive($ctx = null)
  {
    if (is_null($ctx)) {
      $ctx = $this->ctx;
    }
    if (is_null($ctx->getEvent())) {
      if (!is_null($ctx->getParent())) {
        return $this->getEventRecursive($ctx->getParent());
      }
      return null;
    }
    return  $ctx->getEvent();
  }

  public function getSourceId()
  {
    return $this->ctx->getSourceId();
  }

  public function getSource()
  {
    $sourceId = $this->ctx->getSourceId();
    return is_null($sourceId) ? null : Cards::get($sourceId);
  }

  public function resolveAction($args = [], $checkpoint = false)
  {
    $player = Players::getActive();
    $args['automatic'] = $this->isAutomatic($player);
    Engine::resolveAction($args, $checkpoint, $this->ctx);
    Engine::proceed();
  }

  /**
   * Insert flow as child of current node
   */
  public function insertAsChild($flow)
  {
    if (empty($flow)) {
      return;
    }
    Engine::insertAsChild($flow, $this->ctx);
  }

  /**
   * Insert childs on the next upcoming afterFinishingAction node
   */
  public function pushAfterFinishingChilds($childs)
  {
    Engine::pushAfterFinishingChilds($childs);
  }

  /**
   * Insert childs as parallel node childs
   */
  public function pushParallelChild($node)
  {
    $this->pushParallelChilds([$node]);
  }

  public function pushParallelChilds($childs)
  {
    Engine::insertOrUpdateParallelChilds($childs, $this->ctx);
  }

  public function updateParallelChilds($attributes)
  {
    Engine::updateParallelChilds($attributes, $this->ctx);
  }

  public function updateAfterFinishingChilds($attributes)
  {
    Engine::updateAfterFinishingChilds($attributes, $this->ctx);
  }

  /**
   * Given bonuses, compute the flow and insert them as childs (or on insertAfterFinishing node)
   */
  public function insertBonusesFlow($bonuses, $source = '', $sourceType = null, $sourceId = null)
  {
    if (empty($bonuses)) {
      return;
    }

    if (isset($bonuses[0]['type']) || isset($bonuses['type'])) {
      // we already are receiving a node
      $immediate = $bonuses;
      $after = [];
    } else {
      // list($immediate, $after) = FlowConvertor::getFlow($bonuses, $source, $sourceType, $sourceId);
    }
    $this->pushParallelChilds($immediate);
    $this->pushAfterFinishingChilds($after);
  }

  public function getClassName()
  {
    $classname = get_class($this);
    if ($pos = strrpos($classname, '\\')) {
      return substr($classname, $pos + 1);
    }
    return $classname;
  }

  protected function checkListeners($method, $player, $args = [], $overrideMethod = null)
  {
    $event = array_merge(
      [
        'pId' => $player->getId(),
        'type' => 'action',
        'action' => $overrideMethod ?? $this->getClassName(),
        'method' => $overrideMethod ?? $method,
      ],
      $args
    );

    $reaction = Cards::getReaction($event);
    // throw new \feException(print_r($reaction));
    // $this->pushParallelChilds($reaction);
    $this->pushAfterFinishingChilds($reaction);
  }

  protected function logReactions($method, $player, $args = [], $overrideMethod = null)
  {
    $event = array_merge(
      [
        'pId' => $player->getId(),
        'type' => 'action',
        'action' => $overrideMethod == true ? $method : $this->getClassName(),
        'method' =>  $method,
      ],
      $args
    );
    // throw new \feException(print_r($event));
    $reaction = Cards::getReaction($event);
    // throw new \feException(print_r($reaction));
    // $this->pushParallelChilds($reaction);
    return $reaction;
  }

  public function checkAfterListeners($player, $args = [], $duringActionListener = true, $overrideMethod = null)
  {
    if ($duringActionListener) {
      $this->checkListeners($this->getClassName(), $player, $args, $overrideMethod);
    }
    // removed, not sure it's consistent in Altered
    // $this->checkListeners('ImmediatelyAfter' . $this->getClassName(), $player, $args);
    // $this->checkListeners('After' . $this->getClassName(), $player, $args);
  }

  public function checkImmediateListeners($player, $args = [], $duringActionListener = true)
  {
    $event = array_merge(
      [
        'pId' => $player->getId(),
        'type' => 'action',
        'action' => 'Immediate' . $this->getClassName(),
        'method' => 'Immediate' . $this->getClassName(),
      ],
      $args
    );

    $reaction = Cards::getReaction($event, true, false);
    // var_dump($reaction);
    if ($reaction  !== null) {
      Engine::insertAtRoot(['type' => NODE_SEQ, 'childs' => $reaction], false);
    }
  }

  public function checkModifiers($method, &$data, $name, $player, $args = [])
  {
    $args[$name] = $data;
    if (!isset($args['actionCardId'])) {
      $args['actionCardId'] = $this->ctx != null ? $this->ctx->getCardId() : null;
    }
    Cards::applyEffects($player, $method, $args);
    $data = $args[$name];
  }

  public function checkCostModifiers(&$costs, $player, $args = [])
  {
    $this->checkModifiers('computeCosts' . $this->getClassName(), $costs, 'costs', $player, $args);
  }

  public function checkArgsModifiers(&$actionArgs, $player, $args = [])
  {
    $this->checkModifiers('computeArgs' . $this->getClassName(), $actionArgs, 'actionArgs', $player, $args);
  }

  /**
   * Update the args of current node
   * @param array $args : the keys/values that needs to get updated
   * Warning: resolve action must be call on the side
   */
  public function duplicateAction($args = [], $checkpoint = false)
  {
    // Duplicate the node and update the args
    $node = $this->ctx->toArray();
    $node['type'] = \NODE_LEAF;
    $node['childs'] = [];
    $node['args'] = array_merge($node['args'], $args);
    $node['duplicate'] = true;
    unset($node['mandatory']); // Weird edge case
    $node = Engine::buildTree($node);
    // Insert it as a brother of current node and proceed
    $this->ctx->insertAsBrother($node);
    Engine::save();

    if ($checkpoint) {
      Engine::checkpoint();
    }
    // Engine::proceed();
  }

  public function updateCardId($node, $cardId, $cardFrom, $sourceId, $ownerId)
  {
    if (!isset($node['args']['cardId']) || ($node['args']['cardId'] != ME && $node['args']['cardId'] != MANA)) {
      $node['args']['cardId'] = $cardId;
      $node['args']['cardFrom'] = $cardFrom;
      $node['args']['ownerId'] = $ownerId;
    }

    if (!isset($node['pId'])) {
      $node['pId'] = $ownerId;
    }

    if (isset($node['1-3'])) {
      $node['1-3'] = $this->updateCardId($node['1-3'], $cardId, $cardFrom, $sourceId, $ownerId);
    }
    if (isset($node['4+'])) {
      $node['4+'] = $this->updateCardId($node['4+'], $cardId, $cardFrom, $sourceId, $ownerId);
    }

    $node['sourceId'] = $this->getSourceId();

    if (isset($node['args']['effect']) && is_array($node['args']['effect'])) {
      $node['args']['effect'] = $this->updateCardId($node['args']['effect'], $cardId, $cardFrom, $sourceId, $ownerId);
    }

    if (isset($node['childs'])) {
      $node['childs'] = array_map(function ($child) use ($cardId, $cardFrom, $sourceId, $ownerId) {
        return $this->updateCardId($child, $cardId, $cardFrom, $sourceId, $ownerId);
      }, $node['childs']);
    }


    return $node;
  }
}
