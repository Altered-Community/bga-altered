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

const OPTION_REMOVE_SNAKE_IMAGES = 105;
const OPTION_REMOVE_SNAKE_IMAGES_DISABLED = 0;
const OPTION_REMOVE_SNAKE_IMAGES_ENABLED = 1;

const OPTION_REDUCED_COSTS = 106;

const OPTION_FOLDER_COSTS = 107;

const OPTION_ENCLOSURE_SIZE = 108;

const OPTION_BUILDING_BORDERS = 109;

const OPTION_HELPER_PLAYABLE = 110;

/*
 * State constants
 */
const ST_GAME_SETUP = 1;
const ST_DECK_SELECTION = 2;
const ST_SETUP = 3; // tempest setup + deck shuffle + alterer position
const ST_NEW_DAY = 5; // Mana draw, if day 1 = 7 + 3 mana

const ST_BEFORE_ASSIGNMENT = 6;
const ST_ASSIGNMENT = 7;
const ST_CHOOSE_ASSIGNMENT = 8;

// Atomic action
const ST_PLAY_CARD = 10;
// const ST_ACTIVATE_ECHO = 11;
// const ST_ACTIVATE_ALTERER = 12;
// const ST_ACTIVATE_PERMANENT = 13;

// Targeting
const ST_TARGET = 14;

// Effets
const ST_EFFECT_BOOST = 20; // gain X / who
const ST_EFFECT_TOKEN = 21; // invoke a token
const ST_EFFECT_NEW_TURN = 22;

const ST_PRE_RESOLUTION_PHASE = 83; // some effects give choice before counting
const ST_RESOLUTION_PHASE = 84; // resolution of the tempest
const ST_END_OF_DAY = 85; // clean up !! may need some choice
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
// const CHOOSE_ACTION_CARD = 'CHOOSE_ACTION_CARD';
// const GAIN = 'GAIN';
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

const ACTIVE = 1;
const INACTIVE = 0;

const SPONSOR_CARD_WITH_ICON_BONUS = ['S215_BreedingCooperation', 'S218_BreedingProgram'];

const INFTY = 100;
const CORNER = ['x' => 0, 'y' => 11];

// Ability
const SPRINT = 'Sprint';

/******************
 ****** STATS ******
 ******************/

const STAT_BREAKS = 10;

const STAT_POSITION = 11;
const STAT_TURN = 12;
const STAT_BREAKS_TRIGGERED = 13;
const STAT_END_GAME_TRIGGERED = 14;
const STAT_MAP = 15;

const STAT_APPEAL = 16;
const STAT_CONSERVATION = 17;
const STAT_SCORE = 18;
const STAT_REPUTATION = 19;

// Number of times each action was taken
const STAT_BUILD_ACTION = 20;
const STAT_ANIMALS_ACTION = 21;
const STAT_CARDS_ACTION = 22;
const STAT_ASSOCIATION_ACTION = 23;
const STAT_SPONSORS_ACTION = 24;

// X-tokens gained, spent
const STAT_XTOKEN_GAINED = 25;
const STAT_XTOKEN_GAINED_ACTION = 26;
const STAT_XTOKEN_USED = 27;

// Money gained, used
const STAT_MONEY_GAINED = 30;
const STAT_INCOME_TOTAL = 31;
const STAT_MONEY_USED_ANIMALS = 32;
const STAT_MONEY_USED_BUILD = 33;
const STAT_MONEY_USED_DONATIONS = 34;
const STAT_MONEY_USED_FROM_DISPLAY = 35;

// Card drawn, played, discarded
const STAT_CARDS_DRAWN = 40;
const STAT_CARDS_TAKEN = 41;
const STAT_CARDS_SNAPPED = 42;
const STAT_CARDS_DISCARDED = 43;
const STAT_SPONSORS_PLAYED = 44;
const STAT_ANIMALS_PLAYED = 45;
const STAT_ANIMALS_RELEASED = 46;

// Number of association workes, numbers of association taks of each type
const STAT_ASSOCIATION_WORKERS = 50;
const STAT_ASSOCIATION_DONATION = 51;
const STAT_ASSOCIATION_REPUTATION = 52;
const STAT_ASSOCIATION_PARTNER = 53;
const STAT_ASSOCIATION_UNIVERSITY = 54;
const STAT_ASSOCIATION_CONSERVATION = 55;

// Map stats
const STAT_BUILD_ENCLOSURES = 60;
const STAT_BUILD_KIOSKS = 61;
const STAT_BUILD_PAVILIONS = 62;
const STAT_BUILD_STRUCTURES = 63;
const STAT_COVERED_HEXES = 64;
const STAT_EMPTY_HEXES = 65;

// Upgraded action cards
const STAT_CARDS_UPGRADED = 70;
const STAT_CARD_UPGRADED_ANIMALS = 71;
const STAT_CARD_UPGRADED_BUILD = 72;
const STAT_CARD_UPGRADED_CARDS = 73;
const STAT_CARD_UPGRADED_SPONSORS = 74;
const STAT_CARD_UPGRADED_ASSOCATION = 75;

// Icons
const STAT_ICON_AFRICA = 76;
const STAT_ICON_EUROPE = 77;
const STAT_ICON_ASIA = 78;
const STAT_ICON_AUSTRALIA = 79;
const STAT_ICON_AMERICAS = 80;
const STAT_ICON_BIRD = 81;
const STAT_ICON_PREDATOR = 82;
const STAT_ICON_HERBIVORE = 83;
const STAT_ICON_BEAR = 84;
const STAT_ICON_REPTILE = 85;
const STAT_ICON_PRIMATE = 86;
const STAT_ICON_PET = 97;
const STAT_ICON_WATER = 88;
const STAT_ICON_ROCK = 89;
const STAT_ICON_SCIENCE = 90;
