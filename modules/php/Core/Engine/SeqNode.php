<?php

namespace ALT\Core\Engine;

use ALT\Core\Engine;
use ALT\Managers\Players;
/*
 * SeqNode: a class that represent a sequence of actions
 */

class SeqNode extends AbstractNode
{
  public function __construct($infos = [], $childs = [])
  {
    parent::__construct($infos, $childs);
    $this->infos['type'] = NODE_SEQ;
  }

  /**
   * The description of the node is the sequence of description of its children
   */
  public function getDescriptionSeparator()
  {
    return ', ';
  }

  /**
   * A SEQ node is doable if all its children are doable (or if the SEQ node itself is optional)
   * WARNING: this is a very basic check that does not cover the case where the first action might make the second one doable
   *  -> maybe it would make more sense to only check first action ?
   */
  public function isDoable($player)
  {
    $child = current($this->childs);
    if ($child === false) {
      return false;
    }
    return $child->isDoable($player) || $child->isOptional($player);
    // return $this->childsReduceAnd(function ($child) use ($player) {
    //   return $child->isDoable($player) || $child->isOptional($player);
    // });
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
   * An SEQ node is resolved either when marked as resolved, either when all children are resolved already
   *  => if the node was actually an action node and is not resolved fully yet => go back to him
   */
  public function isResolved()
  {
    return parent::isResolved() ||
      $this->childsReduceAnd(function ($child) {
        return $child->isResolved();
      });
  }

  /**
   * Just return the first unresolved children, unless the node itself is optional
   */
  public function getNextUnresolved()
  {
    if ($this->isResolved()) {
      return null;
    }

    if ($this->isOptional(Players::getActive())) {
      return $this;
    }

    foreach ($this->childs as $child) {
      if (!$child->isResolved()) {
        return $child->getNextUnresolved();
      }
    }
  }

  /**
   * We only enter this function if the user decide to enter the SEQ (in the case where the node is optional)
   */
  public function choose($childIndex, $auto = false)
  {
    if ($childIndex != 0) {
      throw new \BgaVisibleSystemException('SEQ Choice shouldnt happen with $childIndex different from 0');
    }
    $this->infos['optional'] = false; // Mark the node as mandatory
  }
}
