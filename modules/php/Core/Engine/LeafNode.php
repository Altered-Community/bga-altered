<?php
namespace ALT\Core\Engine;
use ALT\Managers\Actions;

/*
 * Leaf: a class that represent a Leaf
 */
class LeafNode extends AbstractNode
{
  public function __construct($infos = [])
  {
    parent::__construct($infos, []);
    $this->infos['type'] = NODE_LEAF;
  }

  /**
   * An action leaf is resolved as soon as the action is resolved
   */
  public function isResolved()
  {
    return parent::isResolved() || ($this->getAction() != null && $this->isActionResolved());
  }

  public function isAutomatic($player = null)
  {
    if (!isset($this->infos['action'])) {
      return false;
    }
    return Actions::get($this->infos['action'], $this)->isAutomatic($player);
  }

  public function isIndependent($player = null)
  {
    if (!isset($this->infos['action'])) {
      return false;
    }
    return Actions::get($this->infos['action'], $this)->isIndependent($player);
  }

  public function isOptional()
  {
    if (isset($this->infos['mandatory']) && $this->infos['mandatory']) {
      return false;
    }
    if (parent::isOptional() || !isset($this->infos['action'])) {
      return parent::isOptional();
    }
    return Actions::get($this->infos['action'], $this)->isOptional();
  }

  public function isIrreversible($player = null)
  {
    if (!isset($this->infos['action'])) {
      return false;
    }
    return Actions::get($this->infos['action'], $this)->isIrreversible($player);
  }

  /**
   * A Leaf is doable if the corresponding action is doable by the player
   */
  public function isDoable($player)
  {
    // Useful for a SEQ node where the 2nd node might become doable thanks to the first one
    if (isset($this->infos['willBeDoable'])) {
      return true;
    }
    // Edge case when searching undoable mandatory node pending
    if ($this->isResolved()) {
      return true;
    }
    if (isset($this->infos['action'])) {
      return $player->canTakeAction($this->infos['action'], $this);
    }
    var_dump($this->parent->toArray());
    throw new \BgaVisibleSystemException('Unimplemented isDoable function for non-action Leaf');
  }

  /**
   * The state is either hardcoded into the leaf, or correspond to the attached action
   */
  public function getState()
  {
    if (isset($this->infos['state'])) {
      return $this->infos['state'];
    }

    if (isset($this->infos['action'])) {
      return Actions::getState($this->infos['action'], $this);
    }
    var_dump(\ALT\Core\Engine::$tree->toArray());
    throw new \BgaVisibleSystemException('Trying to get state on a leaf without state nor action');
  }

  /**
   * The description is given by the corresponding action
   */
  public function getDescription()
  {
    if (isset($this->infos['action'])) {
      return Actions::get($this->infos['action'], $this)->getDescription();
    }
    return parent::getDescription();
  }
}
