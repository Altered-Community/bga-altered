<?php

namespace ALT\Core\Engine;

use ALT\Managers\Players;
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

  /**
   * A PARALLEL node is optional if all its mandatory childs are already done
   */
  public function isOptional($player)
  {
    // $player = Players::getActive();
    return $this->getPId() == Players::getActiveId()
      && (parent::isOptional($player) ||
        $this->childsReduceAnd(function ($child) use ($player) {
          return $child->isOptional($player) || $child->isResolved();
        }));
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
