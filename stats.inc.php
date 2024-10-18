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
    'matchUp' => [
      'id' => STAT_MATCHUP,
      'name' => 'matchUp',
      'type' => 'int',
      'display' => 'limited',
    ],
    'gameWinner' => [
      'id' => STAT_MATCHUP,
      'name' => 'gameWinner',
      'type' => 'int',
      'display' => 'limited',
    ]
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
    'card1' => [
      'id' => STAT_CARD_1,
      'name' => 'card 1',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card2' => [
      'id' => STAT_CARD_2,
      'name' => 'card 2',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card3' => [
      'id' => STAT_CARD_3,
      'name' => 'card 3',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card4' => [
      'id' => STAT_CARD_4,
      'name' => 'card 4',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card5' => [
      'id' => STAT_CARD_5,
      'name' => 'card 5',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card6' => [
      'id' => STAT_CARD_6,
      'name' => 'card 6',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card7' => [
      'id' => STAT_CARD_7,
      'name' => 'card 7',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card8' => [
      'id' => STAT_CARD_8,
      'name' => 'card 8',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card9' => [
      'id' => STAT_CARD_9,
      'name' => 'card 9',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card10' => [
      'id' => STAT_CARD_10,
      'name' => 'card 10',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card11' => [
      'id' => STAT_CARD_11,
      'name' => 'card 11',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card12' => [
      'id' => STAT_CARD_12,
      'name' => 'card 12',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card13' => [
      'id' => STAT_CARD_13,
      'name' => 'card 13',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card14' => [
      'id' => STAT_CARD_14,
      'name' => 'card 14',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card15' => [
      'id' => STAT_CARD_15,
      'name' => 'card 15',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card16' => [
      'id' => STAT_CARD_16,
      'name' => 'card 16',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card17' => [
      'id' => STAT_CARD_17,
      'name' => 'card 17',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card18' => [
      'id' => STAT_CARD_18,
      'name' => 'card 18',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card19' => [
      'id' => STAT_CARD_19,
      'name' => 'card 19',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card20' => [
      'id' => STAT_CARD_20,
      'name' => 'card 20',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card21' => [
      'id' => STAT_CARD_21,
      'name' => 'card 21',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card22' => [
      'id' => STAT_CARD_22,
      'name' => 'card 22',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card23' => [
      'id' => STAT_CARD_23,
      'name' => 'card 23',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card24' => [
      'id' => STAT_CARD_24,
      'name' => 'card 24',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card25' => [
      'id' => STAT_CARD_25,
      'name' => 'card 25',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card26' => [
      'id' => STAT_CARD_26,
      'name' => 'card 26',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card27' => [
      'id' => STAT_CARD_27,
      'name' => 'card 27',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card28' => [
      'id' => STAT_CARD_28,
      'name' => 'card 28',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card29' => [
      'id' => STAT_CARD_29,
      'name' => 'card 29',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card30' => [
      'id' => STAT_CARD_30,
      'name' => 'card 30',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card31' => [
      'id' => STAT_CARD_31,
      'name' => 'card 31',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card32' => [
      'id' => STAT_CARD_32,
      'name' => 'card 32',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card33' => [
      'id' => STAT_CARD_33,
      'name' => 'card 33',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card34' => [
      'id' => STAT_CARD_34,
      'name' => 'card 34',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card35' => [
      'id' => STAT_CARD_35,
      'name' => 'card 35',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card36' => [
      'id' => STAT_CARD_36,
      'name' => 'card 36',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card37' => [
      'id' => STAT_CARD_37,
      'name' => 'card 37',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card38' => [
      'id' => STAT_CARD_38,
      'name' => 'card 38',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card39' => [
      'id' => STAT_CARD_39,
      'name' => 'card 39',
      'type' => 'int',
      'display' => 'limited'
    ],
    'card40' => [
      'id' => STAT_CARD_40,
      'name' => 'card 40',
      'type' => 'int',
      'display' => 'limited'
    ]
  ],
];
