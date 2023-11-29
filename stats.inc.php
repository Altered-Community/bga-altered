<?php

/**
 *------
 * BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
 * Altered implementation : © Timothée Pecatte <tim.pecatte@gmail.com>, Vincent Toper <vincent.toper@gmail.com>
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 * stats.inc.php
 *
 * Altered game statistics description
 *
 */

require_once 'modules/php/constants.inc.php';

$stats_type = [
  'table' => [
    'days' => [
      'id' => STAT_DAYS,
      'name' => totranslate('Number of days'),
      'type' => 'int',
    ],
  ],

  'value_labels' => [
    STAT_FACTION => [
      1 => totranslate('Axiom'),
      2 => totranslate('Bravos'),
      3 => totranslate('Lyra'),
      4 => totranslate('Muna'),
      5 => totranslate('Ordis'),
      6 => totranslate('Yzmir')
    ],

    STAT_WINNER => [
      0 => totranslate('No'),
      1 => totranslate('Yes'),
    ],
  ],

  'player' => [
    'faction' => [
      'id' => STAT_FACTION,
      'name' => totranslate('Faction'),
      'type' => 'int',
    ],
    'winner' => [
      'id' => STAT_WINNER,
      'name' => totranslate('Winner'),
      'type' => 'int',
    ],
    'turns' => [
      'id' => STAT_TURN,
      'name' => totranslate('Number of turns'),
      'type' => 'int',
    ],
  ],
];
