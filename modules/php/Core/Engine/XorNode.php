<?php

namespace ALT\Core\Engine;

/*
 * XorNode: a class that represent an Node with a choice (parallel) with a unique possibility
 */

class XorNode extends AbstractNode
{
  public function __construct($infos = [], $childs = [])
  {
    parent::__construct($infos, $childs);
    $this->infos['type'] = NODE_XOR;
  }

  /**
   * The description of the node is the sequence of description of its children
   */
  public function getDescriptionSeparator()
  {
    return ' / ';
  }

  /**
   * An XOR node is doable if at least one of its child is doable (or if the XOR node itself is optional)
   */
  public function isDoable($player)
  {
    return $this->isOptional($player) ||
      $this->childsReduceOr(function ($child) use ($player) {
        return $child->isDoable($player);
      });
  }

  /**
   * A XOR node is resolved as soon as one child is resolved
   */
  public function isResolved()
  {
    // If we passed the node (which might be optional)
    if (parent::isResolved()) {
      return true;
    }

    return $this->childsReduceOr(function ($child) {
      return $child->isResolved();
    });
  }
}
