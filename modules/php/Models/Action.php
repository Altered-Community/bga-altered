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
        throw new \BgaVisibleSystemException('Trying to get value of an undefined arg without any default value : ' . $v);
      }
    }
    return $t;
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

  protected function checkListeners($method, $player, $args = [])
  {
    $event = array_merge(
      [
        'pId' => $player->getId(),
        'type' => 'action',
        'action' => $this->getClassName(),
        'method' => $method,
      ],
      $args
    );

    $reaction = Cards::getReaction($event);
    // throw new \feException(print_r($reaction));
    $this->pushAfterFinishingChilds($reaction);
  }

  public function checkAfterListeners($player, $args = [], $duringActionListener = true)
  {
    if ($duringActionListener) {
      $this->checkListeners($this->getClassName(), $player, $args);
    }
    // removed, not sure it's consistent in Altered
    // $this->checkListeners('ImmediatelyAfter' . $this->getClassName(), $player, $args);
    // $this->checkListeners('After' . $this->getClassName(), $player, $args);
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
}
