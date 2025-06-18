<?php

namespace ALT\Core\Engine;

use ALT\Managers\Players;
use ALT\Core\Globals;
/*
 * ParallelNode: a class that represent an Node with a choice (parallel), some of them being optional, other are mandatory
 */

class ParallelNode extends AbstractNode
{
  public function __construct($infos = [], $childs = [])
  {
    parent::__construct($infos, $childs);
    $this->infos['type'] = NODE_PARALLEL;
  }

  /**
   * The description of the node is the sequence of description of its children
   */
  public function getDescriptionSeparator()
  {
    return ' | ';
  }

  /**
   * A PARALLEL node is doable if all its mandatory childs are doable (or if the PARALLEL node itself is optional)
   */
  public function isDoable($player)
  {
    return $this->isOptional($player) ||
      $this->childsReduceAnd(function ($child) use ($player) {
        return $child->isDoable($player) || $child->isOptional($player);
      });
  }

  public function getPId()
  {
    $players = [];
    foreach ($this->getChilds() as $child) {
      // var_dump("titi");
      if ($child->isResolved()) {
        continue;
      }

      $pId = $child->getPId();
      // throw new \feException($pId);
      if (is_null($pId)) {
        $players[-1] = ($players[-1] ?? 0) + 1;
      } else {
        $players[$pId] = ($players[$pId] ?? 0) + 1;
      }
    }
    // throw new \feException(print_r($players));
    // There are no players defined in the child
    if (count($players) == 1 && isset($players[-1])) {
      return null;
    } elseif (count($players) == 1) {
      // Only one player must choose so we put the node to him
      return array_keys($players)[0];
    }
    return $this->infos['pId'] ?? Globals::getActivePId();
  }

  /**
   * A PARALLEL node is optional if all its mandatory childs are already done
   */
  public function isOptional($player)
  {
    $childWithOtherPlayer = $this->childsReduceAnd(function ($child) use ($player) {
      return (($child->getPId() ?? $player->getId())) != $player->getId() && !$child->isResolved();
    });

    $optional = !$childWithOtherPlayer && (is_null($this->getPId()) || $this->getPId() == $player->getId()) &&
      (parent::isOptional($player) ||
        $this->childsReduceAnd(function ($child) use ($player) {
          return $child->isOptional($player) || $child->isResolved();
        }));

    return $optional;
  }

  public function getUndoableMandatoryNode($player)
  {
    if ($this->isOptional($player)) {
      return null;
    }
    foreach ($this->childs as $child) {
      $node = $child->getUndoableMandatoryNode($player);
      if (!is_null($node)) {
        return $node;
      }
    }
    return null;
  }

  /**
   * An PARALLEL node is resolved either when marked as resolved, either when all children are resolved already
   */
  public function isResolved()
  {
    return parent::isResolved() ||
      $this->childsReduceAnd(function ($child) {
        return $child->isResolved();
      });
  }

  /**
   * Specific case for parallel node : if a node is mandatory and independant, resolve it right away
   */
  public function getChoices($player = null, $displayAllChoices = false)
  {
    $choices = parent::getChoices($player, $displayAllChoices);
    if ($this->infos['noIndependent'] ?? false == true) {
      return $choices;
    }
    $independentChoices = array_values(
      \array_filter($choices, function ($choice) {
        return ($choice['independentAction'] ?? false) && !($choice['optionalAction'] ?? false);
      })
    );
    if (count($independentChoices)) {
      $choice = $independentChoices[0];
      return [$choice['id'] => $choice];
    } else {
      return $choices;
    }
  }
}
