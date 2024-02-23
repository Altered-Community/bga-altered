<?php

namespace ALT\Managers;

use ALT\Core\Game;
use ALT\Core\Engine;
use ALT\Core\Notifications;
use ALT\Helpers\Log;
use ALT\Managers\Players;

/* Class to manage all the actions for Altered */

class Actions
{
  static $classes = [
    CHOOSE_ASSIGNMENT,
    DISCARD,
    GAIN,
    TARGET,
    LOOSE,
    SPELL_CLEANUP,
    INVOKE_TOKEN,
    ACTIVATE_CARD,
    DRAW,
    SPECIAL_EFFECT,
    CHECK_CONDITION,
    AFTER_YOU,
    ROLL_DIE,
    RESUPPLY,
    MOVE_EXPEDITION,
    USE_COUNTER,
    ACTIVATE_EFFECT,
    TAP,
    PLAY_CARD,
    MOVE_CARD,
    PAY,
    DRAW_MANA,
    BLOCK_EXPEDITION
  ];

  public static function get($actionId, &$ctx = null)
  {
    if (!in_array($actionId, self::$classes)) {
      throw new \BgaVisibleSystemException('Trying to get an atomic action not defined in Actions.php : ' . $actionId);
    }
    $name = '\ALT\Actions\\' . $actionId;
    return new $name($ctx);
  }

  public static function isDoable($actionId, $ctx, $player)
  {
    $res = self::get($actionId, $ctx)->isDoable($player);
    return $res;
  }

  public static function getErrorMessage($actionId)
  {
    $actionId = ucfirst(mb_strtolower($actionId));
    $msg = sprintf(
      Game::get()::translate(
        'Attempting to take an action (%s) that is not possible. Either another card erroneously flagged this action as possible, or this action was possible until another card interfered.'
      ),
      $actionId
    );
    return $msg;
  }

  public static function getState($actionId, $ctx)
  {
    return self::get($actionId, $ctx)->getState();
  }

  public static function getArgs($actionId, $ctx)
  {
    $action = self::get($actionId, $ctx);
    $methodName = 'args' . $action->getClassName();
    $args = \method_exists($action, $methodName) ? $action->$methodName() : [];
    return array_merge($args, ['optionalAction' => $ctx->isOptional()]);
  }

  public static function takeAction($actionId, $actionName, $args, &$ctx, $automatic = false)
  {
    $player = Players::getActive();
    if (!self::isDoable($actionId, $ctx, $player)) {
      throw new \BgaUserException(self::getErrorMessage($actionId));
    }

    // Check action
    if (!$automatic) {
      Game::get()->checkAction($actionName);
      $stepId = Log::step();
      Notifications::newUndoableStep($player, $stepId);
    } else {
      Game::get()->gamestate->checkPossibleAction($actionName);
    }

    // Run action
    $action = self::get($actionId, $ctx);
    $methodName = $actionName;
    $result = $action->$methodName(...$args);

    // Resolve action
    $automatic = $ctx->isAutomatic($player);
    $checkpoint = is_null($result) ? false : $result;
    $ctx = $action->getCtx();
    Engine::resolveAction(['actionName' => $actionName, 'args' => $args], $checkpoint, $ctx, $automatic);
    Engine::proceed();
  }

  public static function stAction($actionId, $ctx)
  {
    $player = Players::getActive();
    if (!self::isDoable($actionId, $ctx, $player)) {
      if (!$ctx->isOptional()) {
        if (self::isDoable($actionId, $ctx, $player, true)) {
          Game::get()->gamestate->jumpToState(ST_IMPOSSIBLE_MANDATORY_ACTION);
          return;
        } else {
          throw new \BgaUserException(self::getErrorMessage($actionId));
        }
      } else {
        // Auto pass if optional and not doable
        Game::get()->actPassOptionalAction(true);
        return;
      }
    }

    $action = self::get($actionId, $ctx);
    $methodName = 'st' . $action->getClassName();
    if (\method_exists($action, $methodName)) {
      $result = $action->$methodName();
      if (!is_null($result)) {
        $actionName = 'act' . $action->getClassName();
        self::takeAction($actionId, $actionName, $result, $ctx, true);
        return true; // We are changing state
      }
    }
  }

  public static function stPreAction($actionId, $ctx)
  {
    $action = self::get($actionId, $ctx);
    $methodName = 'stPre' . $action->getClassName();
    if (\method_exists($action, $methodName)) {
      $action->$methodName();
      if ($ctx->isIrreversible(Players::get($ctx->getPId()))) {
        Engine::checkpoint();
      }
    }
  }

  public static function pass($actionId, $ctx)
  {
    if (!$ctx->isOptional()) {
      // self::error($ctx->toArray());
      throw new \BgaVisibleSystemException('This action is not optional');
    }

    $action = self::get($actionId, $ctx);
    $methodName = 'actPass' . $action->getClassName();
    if (\method_exists($action, $methodName)) {
      $action->$methodName();
    } else {
      Engine::resolve(PASS);
    }

    Engine::proceed();
  }
}
