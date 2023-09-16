<?php
/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * Altered implementation : © <Your name here> <Your email address here>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * states.inc.php
 *
 * Altered game states description
 *
 */

$machinestates = [
  // The initial state. Please do not modify.
  ST_GAME_SETUP => [
    'name' => 'gameSetup',
    'description' => '',
    'type' => 'manager',
    'action' => 'stGameSetup',
    'transitions' => ['' => ST_DECK_SELECTION],
  ],

  ST_GENERIC_NEXT_PLAYER => [
    'name' => 'genericNextPlayer',
    'type' => 'game',
  ],

  ST_DECK_SELECTION => [
    'name' => 'deckSelection',
    'description' => clienttranslate('Waiting for others to choose their deck'),
    'descriptionmyturn' => clienttranslate('${you} must select the deck you want to play'),
    'type' => 'multipleactiveplayer',
    'args' => 'argsDeckSelection',
    'action' => 'stDeckSelection',
    'possibleactions' => ['actDeckSelection'],
    'transitions' => ['done' => ST_SETUP, 'zombiePass' => ST_SETUP],
  ],

  ST_SETUP => [
    'name' => 'deckSetup',
    'type' => 'game',
    'action' => 'stDeckSetup',
    'transitions' => ['' => ST_FIRST_DAY_MULTI],
  ],

  ST_FIRST_DAY_MULTI => [
    'name' => 'multiactiveDay',
    'type' => 'game',
    'action' => 'stFirstDay',
    'transitions' => ['' => ST_FIRST_DAY_MANA],
  ],

  ST_FIRST_DAY_MANA => [
    'name' => 'firstDayMana',
    'type' => 'multipleactiveplayer',
    'description' => clienttranslate('Waiting for other players to select cards to mana'),
    'descriptionmyturn' => clienttranslate('${you} must select 3 cards to discard as mana'),
    'args' => 'argsFirstDayMana',
    'possibleactions' => ['actFirstDayMana', 'actCancelFirstDayMana'],
    'transitions' => ['done' => ST_BEFORE_ASSIGNMENT, 'zombiePass' => ST_BEFORE_ASSIGNMENT],
  ],

  ST_NEW_DAY => [
    'name' => 'newDay',
    'description' => '',
    'type' => 'game',
    'action' => 'stNewDay',
    'transitions' => [
      'done' => ST_BEFORE_ASSIGNMENT,
    ],
  ],

  //////////////////////////////
  //  _____
  // |_   _|   _ _ __ _ __
  //   | || | | | '__| '_ \
  //   | || |_| | |  | | | |
  //   |_| \__,_|_|  |_| |_|
  //////////////////////////////

  ST_BEFORE_ASSIGNMENT => [
    'name' => 'beforeAssignment',
    'description' => '',
    'type' => 'game',
    'action' => 'stBeforeAssignment',
    'updateGameProgression' => true,
  ],

  ST_ASSIGNMENT => [
    'name' => 'assigment',
    'description' => '',
    'type' => 'game',
    'action' => 'stAssignment',
    'transitions' => [
      'done' => ST_PRE_DUSK_PHASE,
    ],
  ],

  ST_PRE_DUSK_PHASE => [
    'name' => 'beforeDusk',
    'description' => '',
    'type' => 'game',
    'action' => 'stBeforeDusk',
    'transitions' => [
      'done' => ST_DUSK,
    ],
  ],

  ST_DUSK => [
    'name' => 'dusk',
    'description' => '',
    'type' => 'game',
    'action' => 'stDusk',
    'transitions' => [
      'done' => ST_PRE_NIGHT,
    ],
  ],

  ST_PRE_NIGHT => [
    'name' => 'beforeNight',
    'description' => '',
    'type' => 'game',
    'action' => 'stBeforeNight',
    'transitions' => [
      'done' => ST_NIGHT,
    ],
  ],

  ST_NIGHT => [
    'name' => 'beforeNight',
    'description' => '',
    'type' => 'game',
    'action' => 'stBeforeNight',
    'transitions' => [
      'newTurn' => ST_NEW_DAY,
      'endOfGame' => ST_PRE_END_OF_GAME,
    ],
  ],

  ////////////////////////////////////////////////////////////////////////////
  //     _   _                  _         _        _   _
  //    / \ | |_ ___  _ __ ___ (_) ___   / \   ___| |_(_) ___  _ __  ___
  //   / _ \| __/ _ \| '_ ` _ \| |/ __| / _ \ / __| __| |/ _ \| '_ \/ __|
  //  / ___ \ || (_) | | | | | | | (__ / ___ \ (__| |_| | (_) | | | \__ \
  // /_/   \_\__\___/|_| |_| |_|_|\___/_/   \_\___|\__|_|\___/|_| |_|___/
  //
  ////////////////////////////////////////////////////////////////////////////

  ST_CHOOSE_ASSIGNMENT => [
    'name' => 'chooseAssignment',
    'description' => clienttranslate('${actplayer} must choose an action or pass'),
    'descriptionmyturn' => clienttranslate('${you} must choose an action or pass'),
    'args' => 'argsAtomicAction',
    'type' => 'activeplayer',
    'possibleactions' => ['actHand', 'actMemory', 'actEcho', 'actTap', 'actPass', 'actRestart'],
  ],

  ST_PLAY_CARD => [
    // args will contain Id + effect, should be auto. Will trigger the cost (if any, etc.)
    'name' => 'playCard',
    'action' => 'stAtomicAction',
    'type' => 'game',
  ],

  ST_TARGET => [
    'name' => 'target',
    'description' => clienttranslate('${player} must target a ${targetType}'),
    'descriptionmyturn' => clienttranslate('${you} must target a ${targetType}'),
    'args' => 'argsAtomicAction',
    'action' => 'stAtomicAction',
    'type' => 'activeplayer',
    'possibleactions' => ['actTarget', 'actRestart'],
  ],

  ////////////////////////////////////
  //  _____             _
  // | ____|_ __   __ _(_)_ __   ___
  // |  _| | '_ \ / _` | | '_ \ / _ \
  // | |___| | | | (_| | | | | |  __/
  // |_____|_| |_|\__, |_|_| |_|\___|
  //              |___/
  ////////////////////////////////////
  ST_RESOLVE_STACK => [
    'name' => 'resolveStack',
    'type' => 'game',
    'action' => 'stResolveStack',
    'transitions' => [],
  ],

  ST_CONFIRM_TURN => [
    'name' => 'confirmTurn',
    'description' => clienttranslate('${actplayer} must confirm or restart their turn'),
    'descriptionmyturn' => clienttranslate('${you} must confirm or restart your turn'),
    'type' => 'activeplayer',
    'args' => 'argsConfirmTurn',
    'action' => 'stConfirmTurn',
    'possibleactions' => ['actConfirmTurn', 'actRestart'],
    'transitions' => ['endOfDay' => ''],
  ],

  ST_CONFIRM_PARTIAL_TURN => [
    'name' => 'confirmPartialTurn',
    'description' => clienttranslate('${actplayer} must confirm the switch of player'),
    'descriptionmyturn' => clienttranslate('${you} must confirm the switch of player. You will not be able to restart turn'),
    'type' => 'activeplayer',
    'args' => 'argsConfirmTurn',
    // 'action' => 'stConfirmPartialTurn',
    'possibleactions' => ['actConfirmPartialTurn', 'actRestart'],
  ],

  ST_RESOLVE_CHOICE => [
    'name' => 'resolveChoice',
    'description' => clienttranslate('${actplayer} must choose which effect to resolve'),
    'descriptionmyturn' => clienttranslate('${you} must choose which effect to resolve'),
    'descriptionxor' => clienttranslate('${actplayer} must choose exactly one effect'),
    'descriptionmyturnxor' => clienttranslate('${you} must choose exactly one effect'),
    'type' => 'activeplayer',
    'args' => 'argsResolveChoice',
    'action' => 'stResolveChoice',
    'possibleactions' => ['actChooseAction', 'actRestart'],
    'transitions' => [],
  ],

  ST_IMPOSSIBLE_MANDATORY_ACTION => [
    'name' => 'impossibleAction',
    'description' => clienttranslate('${actplayer} can\'t take the mandatory action and must restart his turn or exchange/cook'),
    'descriptionmyturn' => clienttranslate(
      '${you} can\'t take the mandatory action. Restart your turn or exchange/cook to make it possible'
    ),
    'type' => 'activeplayer',
    'args' => 'argsImpossibleAction',
    'possibleactions' => ['actRestart'],
  ],

  // END OF GAME
  ST_PRE_END_OF_GAME => [
    'name' => 'preEndOfGame',
    'type' => 'game',
    'action' => 'stPreEndOfGame',
    'transitions' => ['' => ST_END_GAME],
  ],

  // Final state.
  // Please do not modify (and do not overload action/args methods).
  ST_END_GAME => [
    'name' => 'gameEnd',
    'description' => clienttranslate('End of game'),
    'type' => 'manager',
    'action' => 'stGameEnd',
    'args' => 'argGameEnd',
  ],
];
