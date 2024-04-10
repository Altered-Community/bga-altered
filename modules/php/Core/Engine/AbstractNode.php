<?php

namespace ALT\Core\Engine;

use ALT\Core\Globals;
use ALT\Managers\Players;

/*
 * AbstractNode: a class that represent an abstract Node
 */

class AbstractNode
{
  protected $childs = [];
  protected $parent = null;
  protected $infos = [];

  public function __construct($infos = [], $childs = [])
  {
    $this->infos = $infos;
    $this->childs = $childs;

    foreach ($this->childs as $child) {
      $child->attach($this);
    }
  }

  /**********************
   *** Tree utilities ***
   **********************/
  public function attach($parent)
  {
    $this->parent = $parent;
  }

  public function replaceAtPos($node, $index)
  {
    $this->childs[$index] = $node;
    $node->attach($this);
    return $node;
  }

  public function getIndex()
  {
    if ($this->parent == null) {
      return null;
    }

    foreach ($this->parent->getChilds() as $i => $child) {
      if ($child === $this) {
        return $i;
      }
    }
    throw new \BgaVisibleSystemException("Can't find index of a child");
  }

  public function replace($newNode)
  {
    $index = $this->getIndex();
    if (is_null($index)) {
      throw new \BgaVisibleSystemException('Trying to replace the root');
    }
    return $this->parent->replaceAtPos($newNode, $index);
  }

  public function pushChild($child)
  {
    array_push($this->childs, $child);
    $child->attach($this);
  }

  public function insertAsBrother($newNode)
  {
    $index = $this->getIndex();
    if (is_null($index)) {
      throw new \BgaVisibleSystemException('Trying to insert a brother of the root');
    }
    // Ensure parent is a seq node
    if (!$this->parent instanceof \ARK\Core\Engine\SeqNode) {
      $newParent = new \ARK\Core\Engine\SeqNode([], []);
      $newParent = $this->parent->replaceAtPos($newParent, $index);
      $newParent->pushChild($this);
    }

    return $this->parent->insertChildAtPos($newNode, $index);
  }

  public function insertChildAtPos($node, $index)
  {
    array_splice($this->childs, $index + 1, 0, [$node]);
    $node->attach($this);
    return $node;
  }

  public function unshiftChild($child)
  {
    array_unshift($this->childs, $child);
    $child->attach($this);
  }

  public function getParent()
  {
    return $this->parent;
  }

  public function getChilds()
  {
    return $this->childs;
  }

  public function countChilds()
  {
    return count($this->childs);
  }

  public function toArray()
  {
    return array_merge($this->infos, [
      'childs' => \array_map(function ($child) {
        return $child->toArray();
      }, $this->childs),
    ]);
  }

  protected function childsReduceAnd($callable)
  {
    return \array_reduce(
      $this->childs,
      function ($acc, $child) use ($callable) {
        return $acc && $callable($child);
      },
      true
    );
  }

  protected function childsReduceOr($callable)
  {
    return \array_reduce(
      $this->childs,
      function ($acc, $child) use ($callable) {
        return $acc || $callable($child);
      },
      false
    );
  }

  /**
   * The description of the node is the sequence of description of its children, separated by a separator
   */
  public function getDescription()
  {
    $i = 0;
    $desc = [];
    $args = [];

    if (isset($this->infos['customDescription'])) {
      return $this->infos['customDescription'];
    }

    foreach ($this->childs as $child) {
      $name = 'action' . $i++;
      $tmp = $child->getDescription();
      if ($tmp != '') {
        $args[$name] = $tmp;
        $args['i18n'][] = $name;

        if ($child->forceConfirmation()) {
          $tmp = [
            'log' => clienttranslate('Allow ${player_name} to take a triggered action'),
            'args' => [
              'player_name' => Players::get($child->getPId())->getName(),
            ],
          ];
        }
        $args[$name] = $tmp;
        $args['i18n'][] = $name;
        $desc[] = '${' . $name . '}';
      }
    }

    return [
      'log' => \implode($this->getDescriptionSeparator(), $desc),
      'args' => $args,
    ];
  }

  public function getDescriptionSeparator()
  {
    return '';
  }

  /***********************
   *** Getters (sugar) ***
   ***********************/
  public function getState()
  {
    return $this->infos['state'] ?? null;
  }

  public function getPId()
  {
    return $this->infos['pId'] ?? null;
  }

  public function getType()
  {
    return $this->infos['type'] ?? NODE_LEAF;
  }

  public function getFlag()
  {
    return $this->infos['flag'] ?? null;
  }

  public function getArgs()
  {
    return $this->infos['args'] ?? null;
  }

  public function getCardId()
  {
    return $this->infos['cardId'] ?? null;
  }

  public function getSource()
  {
    return $this->infos['source'] ?? null;
  }

  public function getSourceId()
  {
    return $this->infos['sourceId'] ?? null;
  }

  public function isDoable($player)
  {
    return true;
  }
  public function getUndoableMandatoryNode($player)
  {
    if (!$this->isResolved() && !$this->isDoable($player) && ($this->isMandatory() || !$this->isOptional($player))) {
      return $this;
    }
    return null;
  }

  public function forceConfirmation()
  {
    return $this->infos['forceConfirmation'] ?? false;
  }

  public function isReUsable()
  {
    return $this->infos['reusable'] ?? false;
  }

  public function isResolvingParent()
  {
    return $this->infos['resolveParent'] ?? false;
  }

  /***********************
   *** Node resolution ***
   ***********************/
  public function isResolved()
  {
    return isset($this->infos['resolved']) && $this->infos['resolved'];
  }

  public function getResolutionArgs()
  {
    return $this->infos['resolutionArgs'] ?? null;
  }

  public function getNextUnresolved()
  {
    if ($this->isResolved()) {
      return null;
    }

    if (!isset($this->infos['choice']) || $this->childs[$this->infos['choice']]->isResolved()) {
      return $this;
    } else {
      return $this->childs[$this->infos['choice']]->getNextUnresolved();
    }
  }

  public function resolve($args)
  {
    $this->infos['resolved'] = true;
    $this->infos['resolutionArgs'] = $args;
  }

  // Useful for zombie players
  public function clearZombieNodes($pId)
  {
    foreach ($this->childs as $child) {
      $child->clearZombieNodes($pId);
    }

    if ($this->getPId() == $pId) {
      $this->resolve(ZOMBIE);
    }
  }

  /********************
   *** Node choices ***
   ********************/
  public function areChildrenOptional()
  {
    return false;
  }

  public function isOptional($player)
  {
    return $this->infos['optional'] ?? $this->parent != null && $this->parent->areChildrenOptional();
  }

  public function isAutomatic($player = null)
  {
    $choices = $this->getChoices($player);
    return count($choices) < 2;
  }

  // Allow for automatic resolution in parallel node
  public function isIndependent($player = null)
  {
    return $this->isAutomatic($player) &&
      $this->childsReduceAnd(function ($child) use ($player) {
        return $child->isIndependent($player);
      });
  }

  public function getChoices($player = null, $displayAllChoices = false)
  {
    $choice = null;
    $choices = [];
    $childs = $this->getType() == NODE_SEQ && !empty($this->childs) ? [0 => $this->childs[0]] : $this->childs;

    foreach ($childs as $id => $child) {
      if (!$child->isResolved() && ($displayAllChoices || $child->isDoable($player))) {
        $choice = [
          'id' => $id,
          'description' => $this->getType() == NODE_SEQ ? $this->getDescription() : $child->getDescription(),
          'args' => $child->getArgs(),
          'optionalAction' => $child->isOptional($player),
          'automaticAction' => $child->isAutomatic($player),
          'independentAction' => $child->isIndependent($player),
          'irreversibleAction' => $child->isIrreversible($player),
          'source' => $child->getSource(),
          'sourceId' => $child->getSourceId(),
        ];
        $choices[$id] = $choice;
      }
    }

    if ($this->isOptional($player) || empty($choices)) {
      if (count($choices) != 1 || !$choice['optionalAction'] || $choice['automaticAction']) {
        $choices[PASS] = [
          'id' => PASS,
          'description' => clienttranslate('Pass'),
          'irreversibleAction' => false,
          'args' => [],
        ];
      }
    }

    return $choices;
  }

  public function choose($childIndex, $auto = false)
  {
    $this->infos['choice'] = $childIndex;
    $child = $this->childs[$this->infos['choice']];
    if (!$auto && !($child instanceof \ARK\Core\Engine\LeafNode)) {
      $child->enforceMandatory();
    }
  }

  public function unchoose()
  {
    unset($this->infos['choice']);
  }

  /************************
   ***** Reversibility *****
   ************************/
  public function isIrreversible($player = null)
  {
    return false;
  }

  public function flagStPreAction()
  {
    $this->infos['flag'] = PRE_ACTION_DONE;
  }

  /************************
   *** Action resolution ***
   ************************/
  // Declared here because some action leafs can become SEQ nodes once triggered
  // -> we need to distinguish the action resolution from the node resolution
  public function getAction()
  {
    return $this->infos['action'] ?? null;
  }

  public function isActionResolved()
  {
    return $this->infos['actionResolved'] ?? false;
  }

  public function getActionResolutionArgs()
  {
    return $this->infos['actionResolutionArgs'] ?? null;
  }

  public function resolveAction($args)
  {
    $this->infos['actionResolved'] = true;
    $this->infos['actionResolutionArgs'] = $args;
    $this->infos['optional'] = false;
  }

  // TODO : remove;
  public function unresolveAction()
  {
    unset($this->infos['actionResolved']);
    unset($this->infos['actionResolutionArgs']);
    unset($this->infos['optional']);
  }

  // Useful for scholar
  public function getResolvedActions($types)
  {
    $actions = [];
    if (in_array($this->getAction(), $types) && $this->isActionResolved()) {
      $actions[] = $this;
    }
    foreach ($this->childs as $child) {
      $actions = array_merge($actions, $child->getResolvedActions($types));
    }
    return $actions;
  }

  // Useful for Potter Ceramics
  public function getNextSibling()
  {
    $id = $this->getIndex();
    $childs = $this->getParent()->getChilds();
    return $childs[$id + 1];
  }

  public function enforceMandatory()
  {
    $this->infos['mandatory'] = true;
  }

  public function isMandatory()
  {
    return $this->infos['mandatory'] ?? false;
  }
}
