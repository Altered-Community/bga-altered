<?php

/*
 * Game options
 */

// const OPTION_COMPETITIVE_LEVEL = 102;
// const OPTION_COMPETITIVE_FIRST_GAME = 0;
// const OPTION_COMPETITIVE_BEGINNER = 1;
// const OPTION_COMPETITIVE_NORMAL = 2;
// const OPTION_COMPETITIVE_CUSTOM_SETUP = 3;
// const OPTION_COMPETITIVE_CUSTOM_SETUP_NON_BEGINNER = 4;
// const OPTION_COMPETITIVE_ALL_SAME_SETUP = 5;

// const OPTION_PEACEFUL_MODE = 103;
// const OPTION_PEACEFUL_MODE_DISABLED = 0;
// const OPTION_PEACEFUL_MODE_ENABLED = 1;

// const OPTION_SOLO_DIFFICULTY = 104;
// const OPTION_SOLO_DIFFICULTY_BEGINNER = 0;
// const OPTION_SOLO_DIFFICULTY_NORMAL = 1;
// const OPTION_SOLO_DIFFICULTY_HARD = 2;

// const OPTION_SOLO_CHALLENGE = 106;
// const OPTION_CHALLENGE_YES = 1;
// const OPTION_CHALLENGE_NO = 0;

// const OPTION_SAME_MAP_MODE = 105;
// const OPTION_SAME_MAP_RANDOM = 0;

/*
 * User preferences
 */
const OPTION_CONFIRM = 103;
const OPTION_CONFIRM_DISABLED = 0;
const OPTION_CONFIRM_ENABLED = 2;
const OPTION_CONFIRM_TIMER = 3;

const OPTION_CONFIRM_UNDOABLE = 104;

/*
 * State constants
 */
const ST_GAME_SETUP = 1;
const ST_DECK_SELECTION = 2;
const ST_SETUP = 3; // tempest setup + deck shuffle + alterer position
const ST_FIRST_DAY_MULTI = 4;
const ST_FIRST_DAY_MANA = 5;
const ST_NEW_DAY = 6; // Mana draw, if day 1 = 7 + 3 mana
const ST_NEW_DAY_MULTI = 7;
const ST_NEW_DAY_BONUS = 8;

const ST_BEFORE_ASSIGNMENT = 9;
const ST_ASSIGNMENT = 10;
const ST_CHOOSE_ASSIGNMENT = 11;

// Atomic action
const ST_DISCARD = 12;
const ST_GAIN = 13;
// const ST_ACTIVATE_ECHO = 11;
// const ST_ACTIVATE_ALTERER = 12;
// const ST_ACTIVATE_PERMANENT = 13;

// Targeting
const ST_TARGET = 14;

// Effets
const ST_EFFECT_BOOST = 20; // gain X / who
const ST_EFFECT_TOKEN = 21; // invoke a token
const ST_EFFECT_NEW_TURN = 22;

const ST_PRE_DUSK_PHASE = 83; // some effects give choice before counting
const ST_DUSK = 84; // resolution of the tempest
const ST_BEFORE_NIGHT = 85;
const ST_NIGHT = 86; // clean up !! may need some choice
const ST_RESOLVE_STACK = 90;
const ST_RESOLVE_CHOICE = 91;
const ST_IMPOSSIBLE_MANDATORY_ACTION = 92;
const ST_CONFIRM_TURN = 93;
const ST_CONFIRM_PARTIAL_TURN = 94;

const ST_GENERIC_NEXT_PLAYER = 97;
const ST_PRE_END_OF_GAME = 98;
const ST_END_GAME = 99;

/*
 * ENGINE
 */
const NODE_SEQ = 'seq';
const NODE_OR = 'or';
const NODE_XOR = 'xor';
const NODE_PARALLEL = 'parallel';
const NODE_LEAF = 'leaf';

const ZOMBIE = 98;
const PASS = 99;

const AFTER_FINISHING_ACTION = 'afterFinishing';

/*
 * Atomic action
 */

const ACTIVATE_CARD = 'ACTIVATE_CARD';
const SPECIAL_EFFECT = 'SPECIAL_EFFECT';
const MANA = 'MANA';
const CHOOSE_ASSIGNMENT = 'CHOOSE_ASSIGNMENT';
const GAIN = 'GAIN';
const DISCARD = 'DISCARD';
const TARGET = 'TARGET';
// const ADVANCE_BREAK = 'ADVANCE_BREAK';
// const PAY = 'PAY';
// const CLEANUP = 'CLEANUP';
// const DISCARD = 'DISCARD';
// const UPGRADE_CARD = 'UPGRADE_CARD';
// const DISCARD_SCORING = 'DISCARD_SCORING';
// const DISCARD_SCORING_MULTI = 'DISCARD_SCORING_MULTI';
// const RELEASE = 'RELEASE';
// const TAKE_BONUS = 'TAKE_BONUS';
// const REMOVE_BONUS = 'REMOVE_BONUS';
// const MOVE_ANIMALS = 'MOVE_ANIMALS';
// const GAIN_UNIVERSITY = 'GAIN_UNIVERSITY';
// const GAIN_PARTNER_ZOO = 'GAIN_PARTNER_ZOO';
// const BUY_SPONSOR = 'BUY_SPONSOR';
// const VENOM_PAY = 'VENOM_PAY';
// const WAZA_SPECIAL = 'WAZA_SPECIAL';

////////////// Flow convertor constants
const TARGET_ALL_EXPLORER = 'target_all_explorer';
const TARGET_ALL_EXPLORER_2 = 'target_all_explorer_2';
const SABOTAGE = 'sabotage';

const ACTIVE = 1;
const INACTIVE = 0;

const INFTY = 100;
const MOUNTAIN = 'mountain';
const FOREST = 'forest';
const OCEAN = 'ocean';

const ALTERATEUR = 'alterateur';
const EXPLORER = 'explorer';
const PERMANENT = 'permanent';
const SPELL = 'spell';
const EVERYONE_ELSE = 'everyone-else';

const HAND = 'hand';
const MEMORY = 'memory';

const STORM_LEFT = 'stormLeft';
const STORM_RIGHT = 'stormRight';
const STORMS = [STORM_LEFT, STORM_RIGHT];
const IN_PLAY = [STORM_LEFT, STORM_RIGHT, PERMANENT];

const STORM_CARDS = [
  [[], [FOREST, MOUNTAIN, OCEAN]],
  [[FOREST], [MOUNTAIN, OCEAN]],
  [[MOUNTAIN], [FOREST, OCEAN]],
  [[OCEAN], [MOUNTAIN, FOREST]],
  [[FOREST, MOUNTAIN, OCEAN], []],
];
const STORM_BACK = 5;

const RARITY_BASE = 0;
const RARITY_RARE = 1;
const RARITY_UNIQUE = 2;

const FACTION_BR = 'BR';
const FACTION_MU = 'MU';
const FACTIONS = [FACTION_BR, FACTION_MU];

const OPPONENT = 'opponent';
const ME = 'me';
const ALL = 'all';

/*********************
 ****** MEEPLES ******
 ********************/
const COMPANION = 'companion';

/*********************
 * ****** ABILITIES *****
 *********************/
const FLEETING = 'fleeting';
const BOOST = 'boost';
const GIGANTIC = 'gigantic';
const ANCHORED = 'anchored';
const ASLEEP = 'asleep';

/******************
 ****** STATS ******
 ******************/

const STAT_POSITION = 11;
const STAT_TURN = 12;
