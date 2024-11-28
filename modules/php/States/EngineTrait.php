<?php

namespace ALT\States;

use ALT\Core\Globals;
use ALT\Core\Engine;
use ALT\Core\Game;
use ALT\Core\Notifications;
use ALT\Managers\Players;
use ALT\Managers\Meeples;
use ALT\Managers\Actions;
use ALT\Managers\Cards;
use ALT\Helpers\Log;

trait EngineTrait
{
  function addCommonArgs(&$args)
  {
    $args['previousEngineChoices'] = Globals::getEngineChoices();
    $args['previousSteps'] = Log::getUndoableSteps();
    if (!($args['automaticAction'] ?? false)) {
      if (isset($args['_private']['active'])) {
        $args['_private'][Players::getActiveId()] = $args['_private']['active'];
        unset($args['_private']['active']);
      }

      foreach (Players::getAll() as $pId => $player) {
        // $args['_private'][$pId]['statuses'] = Animals::getPlayableStatuses($player);
      }
    }
  }

  /**
   * Trying to get the atomic action corresponding to the state where the game is
   */
  function getCurrentAtomicAction()
  {
    $node = Engine::getNextUnresolved();
    return $node->getAction();
  }

  /**
   * Ask the corresponding atomic action for its args
   */
  function argsAtomicAction()
  {
    $player = Players::getActive();
    $action = $this->getCurrentAtomicAction();
    $node = Engine::getNextUnresolved();
    $args = Actions::getArgs($action, $node);
    $args['automaticAction'] = Actions::get($action, $node)->isAutomatic($player);
    $this->addArgsAnytimeAction($args, $action);

    $sourceId = $node->getSourceId() ?? null;
    if (!isset($args['source']) && !is_null($sourceId)) {
      $args['sourceId'] = $sourceId;
      $args['source'] = Cards::get($sourceId)->getName();
    }
    $source = $node->getSource() ?? null;
    if (!isset($args['source']) && !is_null($source)) {
      $args['source'] = $source;
    }

    $args['skippedPlayers'] = Globals::getSkippedPlayers();

    return $args;
  }

  /**
   * Add anytime actions
   */
  function addArgsAnytimeAction(&$args, $action)
  {
    $this->addCommonArgs($args);

    // If the action is auto => don't display anytime buttons
    if ($args['automaticAction'] ?? false) {
      return;
    }
    $player = Players::getActive();
    $actions = [];

    // Keep only doable actions
    $anytimeActions = [];
    foreach ($actions as $flow) {
      $tree = Engine::buildTree($flow);
      if ($tree->isDoable($player)) {
        $anytimeActions[] = [
          'flow' => $flow,
          'desc' => $flow['desc'] ?? $tree->getDescription(true),
          'optionalAction' => $tree->isOptional($player),
          'independentAction' => $tree->isIndependent($player),
        ];
      }
    }
    $args['anytimeActions'] = $anytimeActions;
  }

  function actAnytimeAction($choiceId, $auto = false)
  {
    $args = $this->gamestate->state()['args'];
    if (!isset($args['anytimeActions'][$choiceId])) {
      throw new \BgaVisibleSystemException('You can\'t take this anytime action');
    }

    $flow = $args['anytimeActions'][$choiceId]['flow'];
    if (!$auto) {
      Globals::incEngineChoices();
    }
    Engine::insertAtRoot($flow, false);
    Engine::proceed();
  }

  /**
   * Pass the argument of the action to the atomic action
   */
  function actTakeAtomicAction($actionName, $args)
  {
    self::checkAction($actionName);
    $action = $this->getCurrentAtomicAction();
    $ctx = Engine::getNextUnresolved();
    Actions::takeAction($action, $actionName, $args, $ctx);
  }

  /**
   * To pass if the action is an optional one
   */
  function actPassOptionalAction($auto = false)
  {
    if ($auto) {
      $this->gamestate->checkPossibleAction('actPassOptionalAction');
    } else {
      self::checkAction('actPassOptionalAction');
    }

    $action = $this->getCurrentAtomicAction();
    Actions::pass($action, Engine::getNextUnresolved());
  }

  /**
   * Pass the argument of the action to the atomic action
   */
  function stAtomicAction()
  {
    $action = $this->getCurrentAtomicAction();
    Actions::stAction($action, Engine::getNextUnresolved());
  }

  /********************************
   ********************************
   ********** FLOW CHOICE *********
   ********************************
   ********************************/
  function argsResolveChoice()
  {
    $player = Players::getActive();
    $node = Engine::getNextUnresolved();
    $args = array_merge($node->getArgs() ?? [], [
      'choices' => Engine::getNextChoice($player),
      'allChoices' => Engine::getNextChoice($player, true),
    ]);
    if ($node instanceof \ALT\Core\Engine\XorNode) {
      $args['descSuffix'] = 'xor';
    }
    $sourceId = $node->getSourceId() ?? null;
    if (!isset($args['source']) && !is_null($sourceId)) {
      $args['sourceId'] = $sourceId;
      $args['source'] = Cards::get($sourceId)->getName();
    }
    if ($node instanceof \ALT\Core\Engine\OrNode && isset($args['n'])) {
      $remaining = $node->getRemainingChoices();
      $args['nRemaining'] = $remaining;
      $args['descSuffix'] = isset($args['descSuffix']) ? $args['descSuffix'] : 'remaining';
    }
    $this->addArgsAnytimeAction($args, 'resolveChoice');
    return $args;
  }

  function actChooseAction($choiceId)
  {
    $player = Players::getActive();
    Engine::chooseNode($player, $choiceId);
  }

  public function stResolveStack() {}

  public function stResolveChoice() {}

  function argsImpossibleAction()
  {
    $player = Players::getActive();
    $node = Engine::getNextUnresolved();

    $args = [
      'desc' => $node->getDescription(),
    ];
    $this->addArgsAnytimeAction($args, 'impossibleAction');
    return $args;
  }

  /*******************************
   ******* CONFIRM / RESTART ******
   ********************************/
  public function argsConfirmTurn()
  {
    $data = [
      'previousEngineChoices' => Globals::getEngineChoices(),
      'previousSteps' => Log::getUndoableSteps(),
      'automaticAction' => false,
    ];
    $this->addArgsAnytimeAction($data, 'confirmTurn');
    return $data;
  }

  public function stConfirmTurn()
  {
    // Check user preference to bypass if DISABLED is picked or if undo is disabled
    $pref = Players::getActive()->getPref(OPTION_CONFIRM);
    if ($pref == OPTION_CONFIRM_DISABLED || Players::getActive()->getPref(OPTION_PLAYER_UNDO) == OPTION_PLAYER_UNDO_DISABLED) {
      $this->actConfirmTurn(true);
    }
  }

  public function actConfirmTurn($auto = false)
  {
    if (!$auto) {
      self::checkAction('actConfirmTurn');
    }
    Engine::confirm();
  }

  public function actConfirmPartialTurn()
  {
    self::checkAction('actConfirmPartialTurn');
    Engine::confirmPartialTurn();
  }

  public function actRestart()
  {
    self::checkAction('actRestart');
    if (Globals::getEngineChoices() < 1) {
      throw new \BgaVisibleSystemException('No choice to undo');
    }
    Engine::restart();
  }

  public function actUndoToStep($stepId)
  {
    self::checkAction('actRestart');
    Engine::undoToStep($stepId);
  }
}
