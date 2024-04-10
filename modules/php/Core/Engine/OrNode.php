<?php

namespace ALT\Core\Engine;

use ALT\Managers\Players;

/*
 * OrNode: a class that represent an Node with a choice (parallel)
 */

class OrNode extends AbstractNode
{
  public function __construct($infos = [], $childs = [])
  {
    parent::__construct($infos, $childs);
    $this->infos['type'] = NODE_OR;
  }

  /**
   * The description of the node is the sequence of description of its children
   */
  public function getDescriptionSeparator()
  {
    return ' + ';
  }

  /**
   * An OR node is doable if at least one of its child is doable (or if the OR node itself is optional)
   */
  public function isDoable($player)
  {
    return $this->isOptional($player) ||
      $this->childsReduceOr(function ($child) use ($player) {
        return $child->isDoable($player);
      });
  }

  /**
   * An OR node become optional as soon as one child is resolved
   */
  public function isOptional($player)
  {
    // $player = Players::getActive();
    return parent::isOptional($player) ||
      $this->childsReduceOr(function ($child) {
        return $child->isResolved() && $child->getResolutionArgs() != PASS;
      });
  }

  /**
   * If at least one child was resolved already, other become optional
   */
  public function areChildrenOptional()
  {
    return $this->childsReduceOr(function ($child) {
      return $child->isResolved() && $child->getResolutionArgs() != PASS;
    });
  }

  /**
   * An OR node is resolved either when marked as resolved, either when all children are resolved already
   */
  public function isResolved()
  {
    return parent::isResolved() ||
      $this->childsReduceAnd(function ($child) {
        return $child->isResolved();
      });
  }
}
