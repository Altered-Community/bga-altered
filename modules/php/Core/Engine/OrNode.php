<?php

namespace ALT\Core\Engine;

use ALT\Managers\Cards;
use ALT\Core\Globals;

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
      (is_null($this->getArgs()['n'] ?? null) &&  $this->childsReduceOr(function ($child) {
        return $child->isResolved() && $child->getResolutionArgs() != PASS;
      }));
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
  /**
   * An OR node is resolved either when marked as resolved, 
   * either when all children (or if n children) are resolved already
   */
  public function isResolved()
  {
    $args = $this->getArgs();

    // $requiredChoices = $this->getN();
    // node is resolved only if the all the choices are done & the child is resolved
    return parent::isResolved() || ($this->getRemainingChoices() <= 0 && $this->childs[$this->infos['choice']]->isResolved());
  }

  public function getN()
  {
    $args = $this->getArgs();
    if (isset($args['n']) && $args['n'] == 'sourceCounter1') {
      if (is_null($this->getSourceId())) {
        return count($this->childs);
      }
      $source = Cards::get($this->getSourceId());
      $args['n'] = ($source->getExtraDatas()['counter'] ?? 0) + 1;
    }
    return ($args && isset($args['n'])) ? $args['n'] : count($this->childs);
  }

  public function getRemainingChoices()
  {
    $args = $this->getArgs();

    $requiredChoices =  $this->getN();
    return $requiredChoices - $this->getCountChoices();
  }
}
