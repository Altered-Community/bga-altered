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
 * gameoptions.inc.php
 *
 * Altered game options description
 *
 * In this file, you can define your game options (= game variants).
 *
 * Note: If your game has no variant, you don't have to modify this file.
 *
 * Note²: All options defined in this file should have a corresponding "game state labels"
 *        with the same ID (see "initGameStateLabels" in altered.game.php)
 *
 * !! It is not a good idea to modify this file when a game is running !!
 *
 */

namespace ALT;

require_once 'modules/php/constants.inc.php';
$game_options = [
  OPTION_TESTING => [
    'name' => 'Testing',
    'values' => [
      OPTION_DISABLED => [
        'name' => 'Disabled',
      ],
      OPTION_ENABLED => [
        'name' => 'Enabled',
      ],
    ]
  ],
  OPTION_UNDO => [
    'name' => clienttranslate('Undo'),
    'values' => [
      OPTION_DISABLED => [
        'name' => 'Disabled',
      ],
      OPTION_ENABLED => [
        'name' => 'Enabled',
      ],
    ]
  ]

];

$game_preferences = [
  OPTION_CONFIRM => [
    'name' => totranslate('Turn confirmation'),
    'needReload' => false,
    'default' => OPTION_CONFIRM_DISABLED,
    'values' => [
      OPTION_CONFIRM_ENABLED => ['name' => totranslate('Enabled')],
      OPTION_CONFIRM_DISABLED => ['name' => totranslate('Disabled')],
      OPTION_CONFIRM_TIMER => ['name' => totranslate('Enabled with timer')],
    ],
  ],
  OPTION_CONFIRM_UNDOABLE => [
    'name' => totranslate('Undoable actions confirmation'),
    'needReload' => false,
    'values' => [
      OPTION_CONFIRM_ENABLED => ['name' => totranslate('Enabled')],
      OPTION_CONFIRM_DISABLED => ['name' => totranslate('Disabled')],
    ],
  ],
];
