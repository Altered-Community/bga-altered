<?php

namespace ALT\Helpers;

use ALT\Core\Globals;
use ALT\Managers\Players;

// Allow to use a short flow description syntax
abstract class FlowConvertor
{
  public function getTriggers()
  {
    return [
      1 => ['description' => clienttranslate('{R}'), 'trigger' => '', 'type' => 'effectReserve'],
      2 => [
        'description' => clienttranslate('When an opponent draws one or more cards or does [RESUPPLY_T] —'),
        'trigger' => ['Draw', 'Resupply', 'Morning'],
        'condition' => 'notMeandDrawNotMana',
      ],
      4 => [
        'description' => clienttranslate('When one of your Expeditions moves forward due to {V} —'),
        'trigger' => 'AfterDusk',
        'condition' => 'movesStormsWithForest',
      ], // to check if bug with Rin
      5 => [
        'description' => clienttranslate('When a Robot joins your Expeditions —'),
        'trigger' => ['ChooseAssignment', 'InvokeToken'],
        'condition' => 'isCardPlayed:robot',
      ],
      7 => [
        'description' => clienttranslate('When I go to Reserve from your hand —'),
        'trigger' => 'Discard',
        'condition' => 'isMyselfDiscarded:hand:reserve',
      ],
      8 => ['description' => clienttranslate('When I\'m sacrificed —'), 'trigger' => 'Discard', 'condition' => 'isSacrificed'],
      10 => [
        'description' => clienttranslate('When you play a Permanent with Hand Cost {3} or more —'),
        'trigger' => 'ChooseAssignment',
        'condition' => 'isCardPlayed:permanent:3',
      ],
      11 => [
        'description' => clienttranslate('When I go to Reserve from the Expedition zone —'),
        'trigger' => 'LeaveExpedition',
        'condition' => 'notFleeting',
      ],
      12 => ['description' => clienttranslate('When I leave the Expedition zone —'), 'trigger' => 'LeaveExpedition'],
      13 => [
        'description' => clienttranslate('When a Character you control gains 1 or more boosts —'),
        'trigger' => 'Gain',
        'condition' => 'isCharacterBoostedAndUntap',
      ], // condition to check
      14 => [
        'description' => clienttranslate('When my Expedition fails to move forward during Dusk — After Rest:'),
        'trigger' => 'AfterDusk',
        'condition' => 'myExpeditionHasNotMoved',
      ],
      15 => [
        'description' => clienttranslate('When you play another Character with a base statistic of 0 —'),
        'trigger' => 'ChooseAssignment',
        'conditions' => ['isCardPlayed:::true', 'isCardPlayedWithZeroStat'],
      ],
      16 => [
        'description' => clienttranslate('When you play a Permanent —'),
        'trigger' => 'ChooseAssignment',
        'condition' => 'isCardPlayed:permanent',
      ],
      17 => ['description' => clienttranslate('At Dusk —'), 'trigger' => 'BeforeDusk'],
      19 => [
        'description' => clienttranslate('When another non-token Character joins your Expeditions —'),
        'trigger' => 'ChooseAssignment',
        'condition' => 'isCardPlayed:characterOnly:::true',
      ],
      20 => ['description' => clienttranslate('At Noon —'), 'trigger' => 'Noon', 'condition' => 'isMe'],
      21 => [
        'description' => clienttranslate('When another Character joins your Expeditions —'),
        'trigger' => ['ChooseAssignment', 'InvokeToken'],
        'condition' => 'isCardPlayed:character:::true',
      ],
      22 => ['description' => clienttranslate('{H}'), 'trigger' => '', 'type' => 'effectHand'],
      23 => ['description' => clienttranslate('[]]')],
      24 => ['description' => clienttranslate('{J}'), 'trigger' => '', 'type' => 'effectPlayed'],
      25 => ['description' => clienttranslate('When you create a token —'), 'trigger' => 'InvokeToken', 'condition' => 'isMe'],
      26 => ['description' => clienttranslate('When you roll one or more dice —'), 'trigger' => 'RollDie', 'condition' => 'isMe'],
      27 => [
        'description' => clienttranslate('When you play a Spell —'),
        'trigger' => 'ChooseAssignment',
        'condition' => 'isCardPlayed:spell',
      ],
      28 => [
        'description' => clienttranslate('When a card leaves your Reserve during the Afternoon —'),
        'trigger' => ['ChooseAssignment', 'Discard'],
        'conditions' => ['isAfternoon', 'isFromReserve'],
      ],
      192 => ['description' => clienttranslate('{D}'), 'trigger' => '', 'type' => 'effectSupport'],
      231 => ['description' => clienttranslate('When I\'m sacrificed —'), 'trigger' => 'Discard', 'condition' => 'isSacrificed'],
      236 => [
        'description' => clienttranslate('When my Expedition fails to move forward during Dusk — After Rest:'),
        'trigger' => 'AfterDusk',
        'condition' => 'myExpeditionHasNotMoved',
      ],
      239 => [
        'description' => clienttranslate('When an opponent draws one or more cards or does [RESUPPLY_T] —'),
        'trigger' => ['Draw', 'Resupply', 'Morning'],
        'condition' => 'notMeandDrawNotMana',
      ],
      240 => ['description' => clienttranslate('When I gain 1 or more boosts —'), 'trigger' => 'Gain', 'condition' => 'hasBoost'],
    ];
  }

  public function getConditions()
  {
    return [
      166 => [
        'description' => clienttranslate('If you control two or more Plants other than me:'),
        'condition' => 'hasControl:plant:2:true',
      ],
      167 => [
        'description' => clienttranslate('If you have three or more base statistics of 0 among Characters you control:'),
        'condition' => 'has3WithZeroStat',
      ],
      168 => ['description' => clienttranslate('If I have 3 or more boosts:'), 'condition' => 'hasBoost:3'],
      169 => [
        'description' => clienttranslate('If you control two or more [BOOSTED_CHA_P] Characters:'),
        'condition' => 'hasControl::2::boosted',
      ],
      170 => [
        'description' => clienttranslate('You may discard one of your Mana Orbs. If you do:'),
        'effect' => FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetLocation' => [MANA],
          'targetType' => [CHARACTER, TOKEN, SPELL, PERMANENT],
          'effect' => FT::SEQ(FT::ACTION(DISCARD, []), 'OUTPUT'),
        ]),
      ],
      171 => [
        'description' => clienttranslate('You may put a card from your hand in Reserve. If it\'s a Permanent:'),
        'effect' => FT::ACTION(
          TARGET,
          [
            'targetType' => [CHARACTER, SPELL, PERMANENT],
            'targetPlayer' => ME,
            'upTo' => true,
            'targetLocation' => [HAND],
            'effect' => FT::SEQ(FT::DISCARD_TO_RESERVE(), 'OUTPUT'),
          ],
          ['optional' => true]
        ),
        'passiveEffect' => [']Discard' => ['conditions' => ['isSource', 'isDiscarded:hand:reserve:permanent']]], // to check
      ],
      172 => [
        'description' => clienttranslate('You may put a card from your hand in Reserve. If it\'s a Spell:'),
        'effect' => FT::ACTION(
          TARGET,
          [
            'targetType' => [CHARACTER, SPELL, PERMANENT],
            'targetPlayer' => ME,
            'upTo' => true,
            'targetLocation' => [HAND],
            'effect' => FT::DISCARD_TO_RESERVE(),
          ],
          ['optional' => true]
        ),
        'passiveEffect' => ['Discard' => ['conditions' => ['isSource', 'isDiscarded:hand:reserve:permanent'], 'effect' => 'OUTPUT']], // to check
      ],
      173 => ['description' => clienttranslate('If you control four or more Characters:'), 'condition' => 'hasControl::4'],
      175 => [
        'description' => clienttranslate('You may sacrifice a Permanent. If you do:'),
        'effect' => FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [PERMANENT],
          'upTo' => true,
          'effect' => FT::SEQ(FT::ACTION(DISCARD, ['desc' => 'sacrifice']), 'OUTPUT'),
        ]),
      ],
      176 => ['description' => clienttranslate('If you control two or more Landmarks:'), 'condition' => 'hasControl:landmark:2'],
      177 => [
        'description' => clienttranslate('Roll a die. On a 4+:'),
        'effect' => FT::ACTION(ROLL_DIE, [
          'effect' => ['4+' => 'OUTPUT'],
        ]),
      ],
      178 => [
        'description' => clienttranslate('You may sacrifice a Character. If you do:'),
        'effect' => FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [TOKEN, CHARACTER],
          'upTo' => true,
          'effect' => FT::SEQ(FT::ACTION(DISCARD, ['desc' => 'sacrifice']), 'OUTPUT'),
        ]),
      ],
      179 => ['description' => clienttranslate('If you control three or more Characters:'), 'condition' => 'hasControl::3'],
      180 => [
        'description' => clienttranslate('You may sacrifice a Character or Permanent. If you do:'),
        'effect' => FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [TOKEN, CHARACTER, PERMANENT],
          'upTo' => true,
          'effect' => FT::SEQ(FT::ACTION(DISCARD, ['desc' => 'sacrifice']), 'OUTPUT'),
        ]),
      ],
      181 => ['description' => clienttranslate('If I have 1 or more boosts:'), 'condition' => 'hasBoost'],
      182 => [
        'description' => clienttranslate('You may put a card from your hand in Reserve. If you do:'),
        'effect' => FT::ACTION(
          TARGET,
          [
            'targetType' => [CHARACTER, SPELL, PERMANENT],
            'targetPlayer' => ME,
            'upTo' => true,
            'targetLocation' => [HAND],
            'effect' => FT::SEQ(FT::DISCARD_TO_RESERVE(), 'OUTPUT'),
          ],
          ['optional' => true]
        ),
      ],
      183 => ['description' => clienttranslate('If I have 2 or more boosts:'), 'condition' => 'hasBoost:2'],
      186 => [
        'description' => clienttranslate('You may pay {1}. If you do:'),
        'effect' => FT::SEQ_OPTIONAL(FT::ACTION(PAY, ['pay' => 1]), 'OUTPUT'),
        'optional' => true,
      ],
      187 => [
        'description' => clienttranslate('You may discard a card from your Reserve. If you do:'),
        'effect' => FT::ACTION(
          TARGET,
          [
            'targetType' => [CHARACTER, SPELL, PERMANENT],
            'targetPlayer' => ME,
            'targetLocation' => [RESERVE],
            'upTo' => true,
            'effect' => FT::SEQ(FT::SEQ(FT::ACTION(DISCARD, []), 'TODO'), 'OUTPUT'),
          ],
          ['optional' => true]
        ),
      ],
      188 => ['description' => clienttranslate('If you control a token:'), 'condition' => 'hasControl:token:1'],
      189 => ['description' => clienttranslate('If you control one or more Landmarks:'), 'condition' => 'hasControl:landmark:1'],
      190 => ['description' => clienttranslate('If I\'m not [FLEETING]:'), 'condition' => 'notFleeting'],
      191 => ['description' => clienttranslate('[]]')],
      198 => ['description' => clienttranslate('If you have less than eight Mana Orbs:'), 'condition' => 'hasLess8Mana'],
      201 => [
        'description' => clienttranslate('Unless you control two or more Plants other than me:'),
        'condition' => 'hasControl:plant:1:true::LTE',
      ],
      202 => [
        'description' => clienttranslate('Unless you control two or more Bureaucrats other than me:'),
        'condition' => 'hasControl:bureaucrat:1:true::LTE',
      ],
      247 => [
        'description' => clienttranslate('You may sacrifice me. If you do:'),
        'effect' => FT::SEQ_OPTIONAL(FT::ACTION(DISCARD, ['desc' => 'sacrifice', 'cardId' => ME]), 'OUTPUT'),
      ],
    ];
  }

  public static function getOutput()
  {
    return [
      29 => [
        clienttranslate('Sacrifice two Characters.'),
        'output' => FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [CHARACTER, TOKEN],
          'n' => 2,
          'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
        ]),
      ],
      30 => [clienttranslate('Target opponent draws a card.'), 'output' => FT::ACTION(DRAW, ['players' => OPPONENT])],
      31 => [clienttranslate('I can\'t be played if you have less than seven Mana Orbs.'), 'attributes' => ['minManaOrbs' => 7]],
      32 => [clienttranslate('I have <DEFENDER>.'), 'attributes' => ['defender' => true]],
      33 => [clienttranslate('I gain <ASLEEP>.'), 'output' => FT::GAIN(ME, ASLEEP)],
      34 => [clienttranslate('I gain <FLEETING>.'), 'output' => FT::GAIN(ME, FLEETING)],
      35 => [clienttranslate('I can\'t be played if you have less than six Mana Orbs.'), 'attributes' => ['minManaOrbs' => 6]],
      36 => [
        clienttranslate('Sacrifice a Character in my Expedition.'),
        'output' => FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [CHARACTER, TOKEN],
          'targetLocation' => ['source'],
          'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
        ]),
      ],
      37 => [clienttranslate('I lose $<FLEETING>.'), 'output' => FT::LOOSE(ME, FLEETING)],
      38 => [
        clienttranslate('You may play me for free and I gain <ASLEEP>.'),
        'output' => FT::SEQ_OPTIONAL(FT::ACTION(PLAY_CARD, ['cardId' => ME, 'free' => true]), FT::GAIN(ME, ASLEEP)),
      ],
      39 => [clienttranslate('Each player draws a card.'), 'output' => FT::ACTION(DRAW, [])],
      40 => [
        clienttranslate('Each player puts the top card of their deck in their Mana zone (as an exhausted Mana Orb).'),
        'output' => FT::ACTION(DRAW, ['location' => MANA, 'tapped' => true]),
      ],
      41 => [
        clienttranslate('You may put a card from your hand in Reserve.'),
        'output' => FT::ACTION(
          TARGET,
          [
            'targetType' => [CHARACTER, SPELL, PERMANENT],
            'targetPlayer' => ME,
            'upTo' => true,
            'targetLocation' => [HAND],
            'effect' => FT::DISCARD_TO_RESERVE(),
          ],
          ['optional' => true]
        ),
      ],
      42 => [
        clienttranslate('You may have target Character other than me lose <FLEETING>.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, TOKEN],
          'targetPlayer' => ME,
          'excludeSelf' => true,
          'targetLocation' => [HAND],
          'effect' => FT::LOOSE(EFFECT, FLEETING),
        ]),
      ],
      43 => [
        clienttranslate('Each player may <RESUPPLY_INF>.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'eachPlayerOptionalResupply']),
      ],
      44 => [clienttranslate('Put me in Reserve.'), 'output' => FT::ACTION(DISCARD, ['destination' => RESERVE, 'cardId' => ME])],
      45 => [
        clienttranslate('The {j}, {h} and {r} triggers of Characters facing me don\'t activate.'),
        'attributes' => ['blockingPower' => true],
      ],
      46 => [clienttranslate('I have <SEASONED>.'), 'attributes' => ['seasoned' => true]],
      47 => [clienttranslate('I have <TOUGH_1>.'), 'attributes' => ['tough' => 1]],
      48 => [
        clienttranslate(
          'If you would roll one or more dice, instead roll that many dice plus one and ignore the roll of your choice.'
        ),
        'attributes' => ['addDice' => 1],
      ],
      49 => [
        clienttranslate('If you would roll a die, you may add 1 to its result. (Choose after you see the result.)'),
        'attributes' => ['addRoll' => 1],
      ],
      50 => [
        clienttranslate('I have <TOUGH_X>, where X is the number of regions between your Hero and Companion.'),
        'attributes' => ['dynamicTough' => 'region'],
      ],
      51 => [clienttranslate('<RESUPPLY>.'), 'output' => FT::ACTION(RESUPPLY, [])],
      52 => [
        clienttranslate('You may return a Spell from your Reserve to your hand.'),
        'output' => FT::ACTION(
          TARGET,
          [
            'targetLocation' => [RESERVE],
            'targetPlayer' => ME,
            'targetType' => [SPELL],
            'effect' => FT::RETURN_TO_HAND(),
          ],
          ['optional' => true]
        ),
      ],
      54 => [clienttranslate('I have [TOUGH_2].'), 'attributes' => ['tough' => 2]],
      56 => [clienttranslate('I gain 1 boost.'), 'output' => FT::GAIN(ME, BOOST)],
      57 => [
        clienttranslate('The next Permanent you play this Afternoon costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 1, 'permanent' => true]],
        ],
      ],
      58 => [
        clienttranslate('The next Plant you play this Afternoon costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => PLANT, 'reduction' => 1, 'permanent' => true]],
        ],
      ],
      59 => [
        clienttranslate('The next Spell you play this Afternoon costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => SPELL, 'reduction' => 1, 'permanent' => true]],
        ],
      ],
      60 => [
        clienttranslate('Activate the {r} triggers of the next Character you play from your hand this turn.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, [
          'effect' => 'triggerEffectOfNextCharacter',
          'args' => ['type' => CHARACTER, 'from' => HAND, 'effect' => RESERVE],
        ]),
      ],
      61 => [
        clienttranslate('You may return a card other than me from your Reserve to your hand.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
          'excludeSelf' => true,
          'targetLocation' => [HAND],
          'upTo' => true,
          'effect' => FT::RETURN_TO_HAND(),
        ]),
      ],
      63 => [
        clienttranslate('The next Bureaucrat you play this Afternoon costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => BUREAUCRAT, 'reduction' => 1, 'permanent' => true]],
        ],
      ],
      64 => [
        clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in my Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => ['source'],
        ]),
      ],
      65 => [
        clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in your Companion Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => [STORM_RIGHT],
        ]),
      ],
      66 => [
        clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in your Hero Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => [STORM_LEFT],
        ]),
      ],
      67 => [
        clienttranslate('Plants you control other than me gain 1 boost.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostAllSubtype', 'args' => ['subType' => PLANT]]),
      ],
      68 => [
        clienttranslate('Roll a die. On a 4+, I gain 2 boosts. On a 1-3, I gain 1 boost.'),
        'output' => FT::ACTION(ROLL_DIE, [
          'effect' => ['1-3' => FT::GAIN(ME, BOOST, 1), '4+' => FT::GAIN(ME, BOOST, 2)],
        ]),
      ],
      69 => [
        clienttranslate('Up to one target Character gains <ASLEEP>.'),
        'output' => FT::ACTION(TARGET, [
          'upTo' => true,
          'targetType' => [CHARACTER, TOKEN],
          'effect' => FT::GAIN(EFFECT, ASLEEP),
        ]),
      ],
      70 => [
        clienttranslate('Up to one target Character gains <FLEETING>].'),
        'output' => FT::ACTION(TARGET, [
          'upTo' => true,
          'targetType' => [CHARACTER, TOKEN],
          'effect' => FT::GAIN(EFFECT, ASLEEP),
        ]),
      ],
      71 => [clienttranslate('Reduce my cost by {1}.'), 'output' => ''], // TODO
      72 => [
        clienttranslate(
          'If you would <RESUPPLY_INF>, instead look at the top two cards of your deck. Put one in Reserve, and discard the other.'
        ),
        'attributes' => ['resupply2' => true],
      ],
      73 => [clienttranslate('Characters you control other than me have [TOUGH_1].'), 'output' => ''], // TODO
      75 => [
        clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in your other Expedition (the one I\'m not in).'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => ['oppositeSource'],
        ]),
      ],
      76 => [
        clienttranslate('Robots you control other than me gain 1 boost.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, [
          'effect' => 'boostAllSubtype',
          'args' => ['subType' => ROBOT, 'excludeSelf' => true],
        ]),
      ],
      77 => [
        clienttranslate('Target Character gains 1 boost.'),
        'output' => FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST])]),
      ],
      78 => [
        clienttranslate('Target Character switches Expedition.'),
        'output' => FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'effect' => FT::ACTION(MOVE_CARD, [])]),
      ],
      79 => [
        clienttranslate('The next card you play this Afternoon costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => ALL, 'permanent' => true, 'reduction' => 1]],
        ],
      ],
      80 => [
        clienttranslate('<SABOTAGE>.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
      ],
      81 => [
        clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in target Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
        ]),
      ],
      82 => [
        clienttranslate('I gain 1 boost for each card in your Reserve.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXReserve']),
      ],
      83 => [
        clienttranslate('Roll a die. On a 4+, draw a card. On a 1-3, <RESUPPLY>.'),
        'output' => FT::ACTION(ROLL_DIE, [
          'effect' => [
            '1-3' => FT::ACTION(RESUPPLY, []),
            '4+' => FT::ACTION(DRAW, ['players' => ME]),
          ],
        ]),
      ],
      84 => [
        clienttranslate('Your Characters have: \"{R} I gain 1 boost.\"'),
        'passive' => [
          'ChooseAssignment' => [
            'condition' => 'isCharacterFromReserveNotBlocked',
            'output' => FT::GAIN(EFFECT, BOOST),
          ],
        ],
      ],
      86 => [
        clienttranslate('I gain 1 boost for each Landmark you control.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXLandmark']),
      ],
      87 => [
        clienttranslate('You may activate the {j} triggers of target Permanent you control.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [PERMANENT],
          'targetPlayer' => ME,
          'hasEffects' => ['Played'],
          'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
        ]),
      ],
      88 => [
        clienttranslate('You may have target Character other than me lose [FLEETING] and gain 1 boost.'),
        'output' => FT::ACTION(TARGET, [
          'upTo' => true,
          'excludeSelf' => true,
          'effect' => FT::SEQ(FT::LOOSE(EFFECT, FLEETING), FT::GAIN(EFFECT, BOOST)),
        ]),
      ],
      89 => [
        clienttranslate('Each player sacrifices a Character.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'AllPlayersSacrifice1']),
      ],
      90 => [clienttranslate('Draw a card.'), 'output' => FT::ACTION(DRAW, ['players' => ME])],
      91 => [
        clienttranslate('Up to one target Character gains <ASLEEP>. You may have it gain 2 boosts.'),
        'output' => FT::ACTION(TARGET, [
          'upTo' => true,
          'effect' => FT::XOR(FT::GAIN(EFFECT, ASLEEP), FT::SEQ(FT::GAIN(EFFECT, ASLEEP), FT::GAIN(EFFECT, BOOST, 2))),
        ]),
      ],
      92 => [
        clienttranslate('Each Character controlled by target player gains <FLEETING>.'),
        'output' => FT::ACTION(TARGET_PLAYER, [
          'opponentsOnly' => false,
          'effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'fleetingAllCharacters']),
        ]),
      ],
      94 => [
        clienttranslate('Up to one target Character with Hand Cost {3} or less other than me gains [ANCHORED].'),
        'output' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'excludeSelf' => true, 'effect' => FT::GAIN(EFFECT, ANCHORED)]),
      ],
      95 => [
        clienttranslate('Characters your opponents play cost {1} more.'),
        'attributes' => ['increaseOpponentCharacterCost' => 1],
      ],
      96 => [
        clienttranslate('Put me in my owner\'s Mana zone (as an exhausted Mana Orb).'),
        'output' => FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => MANA, 'tapped' => true, 'force' => true]),
      ],
      97 => [clienttranslate('I gain 2 boosts.'), 'output' => FT::GAIN(ME, BOOST, 2)],
      98 => [
        clienttranslate('You may return target Character or Permanent with Hand Cost {4} or less to its owner\'s hand.'),
        'output' => FT::ACTION(TARGET, [
          'maxHandCost' => 4,
          'targetType' => [CHARACTER, TOKEN, PERMANENT],
          'effect' => FT::RETURN_TO_HAND(),
        ]),
      ],
      99 => [
        clienttranslate('Roll a die. On a 4+, I gain 3 boosts. On a 1-3, I gain 1 boost.'),
        'output' => FT::ACTION(ROLL_DIE, [
          'effect' => ['1-3' => FT::GAIN(ME, BOOST, 1), '4+' => FT::GAIN(ME, BOOST, 2)],
        ]),
      ],
      100 => [
        clienttranslate('Target Character gains [ANCHORED].'),
        'output' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, ANCHORED)]),
      ],
      101 => [
        clienttranslate('Target Character in your other Expedition (the one I\'m not in) gains 2 boosts.'),
        'output' => FT::ACTION(TARGET, [
          'targetLocation' => ['oppositeSource'],
          'targetPlayer' => ME,
          'effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2]),
        ]),
      ],
      102 => [
        clienttranslate('The next Permanent you play this Afternoon costs {2} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 2, 'permanent' => true]],
        ],
      ],
      104 => [
        clienttranslate('You may discard target Permanent with Hand Cost {4} or more.'),
        'output' => FT::ACTION(TARGET, ['maxHandCost' => 4, 'targetType' => [PERMANENT], 'effect' => FT::ACTION(DISCARD, [])]),
      ],
      105 => [
        clienttranslate('You may put me in my owner\'s Mana zone (as an exhausted Mana Orb).'),
        'output' => FT::ACTION(DISCARD, [
          'cardId' => ME,
          'destination' => MANA,
          'tapped' => true,
          'canPass' => true,
          'force' => true,
        ]),
      ],
      106 => [
        clienttranslate('I gain 2 boosts and lose <FLEETING>.'),
        'output' => FT::SEQ(FT::GAIN(ME, BOOST, 2), FT::LOOSE(ME, FLEETING)),
      ],
      107 => [
        clienttranslate('Create two <ORDIS_RECRUIT> Soldier tokens in my Expedition.'),
        'output' => FT::SEQ(
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => ['source'],
          ]),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => ['source'],
          ])
        ),
      ],
      108 => [
        clienttranslate('I gain 1 boost for each card in each player\'s Reserve.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXReserveAll']),
      ],
      109 => [
        clienttranslate('Up to one target Plant gains 2 boosts.'),
        'output' => FT::ACTION(TARGET, [
          'upTo' => true,
          'subType' => PLANT,
          'effect' => FT::GAIN(EFFECT, BOOST, 2),
        ]),
      ],
      110 => [clienttranslate('I gain [ANCHORED]. (4+)'), 'output' => ''], // TOOD : check how it works :)
      111 => [
        clienttranslate('Put the top card of your deck in your Mana zone (as an exhausted Mana Orb).'),
        'output' => FT::ACTION(DRAW_MANA, []),
      ],
      112 => [clienttranslate('Cards your opponents play cost {1} more.'), 'attributes' => ['increaseOpponentCardsCost' => 1]],
      113 => [
        clienttranslate('You may activate the {j} triggers of up to two target Permanents you control.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [PERMANENT],
          'targetPlayer' => ME,
          'upTo' => true,
          'n' => 2,
          'hasEffects' => ['Played'],
          'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
        ]),
      ],
      115 => [
        clienttranslate('You may return target Character or Permanent with Hand Cost {5} or less to its owner\'s hand.'),
        'output' => FT::ACTION(TARGET, [
          'maxHandCost' => 5,
          'targetType' => [CHARACTER, TOKEN, PERMANENT],
          'effect' => FT::RETURN_TO_HAND(),
        ]),
      ],
      116 => [
        clienttranslate('Target Character other than me gains [FLEETING], [ANCHORED] or [ASLEEP].'),
        'output' => FT::ACTION(TARGET, [
          'effect' => FT::XOR(FT::GAIN(EFFECT, FLEETING), FT::GAIN(EFFECT, ANCHORED), FT::GAIN(EFFECT, ASLEEP)),
        ]),
      ],
      117 => [
        clienttranslate('Characters you control other than me have <TOUGH_2>.'),
        'attributes' => ['excludeUniversalTough' => true, 'dynamicTough' => 'universalCharacter2'],
      ],
      118 => [
        clienttranslate('Create a [BRASSBUG] Robot token in target Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'AX_Common_Brassbug',
          'targetLocation' => STORMS,
        ]),
      ],
      119 => [
        clienttranslate('Target Character gains 2 boosts.'),
        'output' => FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])]),
      ],
      120 => [
        clienttranslate('Up to two target Characters each gain 1 boost.'),
        'output' => FT::ACTION(TARGET, ['upTo' => true, 'n' => 2, 'effect' => FT::ACTION(GAIN, ['type' => BOOST])]),
      ],
      121 => [
        clienttranslate(
          'You may send to Reserve target Character with Hand Cost {X} or less, where X is the number of Characters you control.'
        ),
        'output' => FT::ACTION(TARGET, [
          'maxHandCost' => 'controlledCharacter',
          'upTo' => true,
          'effect' => FT::DISCARD_TO_RESERVE(),
        ]),
      ],
      122 => [
        clienttranslate('You may put me in my owner\'s Mana zone (as an exhausted Mana Orb). If you don\'t, draw a card.'),
        'output' => FT::XOR(
          FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => MANA, 'force' => true, 'tapped' => true]),
          FT::ACTION(DRAW, ['players' => ME])
        ),
      ],
      123 => [clienttranslate('I have <GIGANTIC>.'), 'attributes' => ['gigantic' => true]],
      124 => [clienttranslate('Create an [ORDIS_RECRUIT] Soldier token in each of your Expeditions.'), 'output' => ''],
      125 => [clienttranslate('Each player discards their hand, then draws three cards.'), 'output' => ''],
      126 => [clienttranslate('(unused) Each player sacrifices two Characters.'), 'output' => ''],
      127 => [
        clienttranslate('For each Character you control other than me, you may activate its {j} triggers.'),
        'output' => '',
      ],
      128 => [clienttranslate('For each Permanent you control, you may activate its {j} triggers.'), 'output' => ''],
      129 => [clienttranslate('You may send to Reserve target Character with Hand Cost {3} or less.'), 'output' => ''],
      130 => [clienttranslate('Target opponent discards a card from their hand.'), 'output' => ''],
      131 => [
        clienttranslate('Your other Expedition (the one I\'m not in) and the Expedition facing it can\'t move forward.'),
        'output' => '',
      ],
      132 => [clienttranslate('You may discard target Permanent.'), 'output' => ''],
      133 => [clienttranslate('Characters you control gain 1 boost.'), 'output' => ''],
      134 => [clienttranslate('I gain 3 boosts.'), 'output' => ''],
      135 => [clienttranslate('(unused) Target Character gains 2 boosts and loses [FLEETING].'), 'output' => ''],
      136 => [clienttranslate('You may send to Reserve target Character with Hand Cost {4} or more.'), 'output' => ''],
      137 => [clienttranslate('You may discard target Character with Hand Cost {3} or less.'), 'output' => ''],
      138 => [clienttranslate('You may discard target [FLEETING], [ANCHORED], or [ASLEEP] Character.'), 'output' => ''],
      139 => [
        clienttranslate('You may put target Character or Permanent in its owner\'s Mana zone (as an exhausted Mana Orb).'),
        'output' => '',
      ],
      140 => [clienttranslate('Roll a die. I gain X boosts, where X is the result.'), 'output' => ''],
      141 => [clienttranslate('You may discard target Character with Hand Cost {4} or more.'), 'output' => ''],
      142 => [clienttranslate('I am [ETERNAL].'), 'output' => ''],
      143 => [clienttranslate('Each player discards their hand and their Reserve, then draws three cards.'), 'output' => ''],
      144 => [clienttranslate('You may send target Character to Reserve.'), 'output' => ''],
      145 => [clienttranslate('Roll a die. Target Character gain X boosts, where X is the result.'), 'output' => ''],
      146 => [clienttranslate('Target Character gains 3 boosts.'), 'output' => ''],
      147 => [clienttranslate('You may discard target Character.'), 'output' => ''],
      148 => [clienttranslate('All Characters in target Expedition gain [ASLEEP].'), 'output' => ''],
      149 => [clienttranslate('Your opponent\'s Expedition facing mine moves backwards one region.'), 'output' => ''],
      150 => [clienttranslate('You may return target Character or Permanent to the top of its owner\'s deck.'), 'output' => ''],
      151 => [clienttranslate('Up to two target Characters each gain 2 boosts.'), 'output' => ''],
      152 => [clienttranslate('Draw two cards.'), 'output' => ''],
      153 => [clienttranslate('(unused) I gain 4 boosts.'), 'output' => ''],
      154 => [clienttranslate('You may discard target Character or Permanent.'), 'output' => ''],
      155 => [clienttranslate('Put the top two cards of your deck in your Mana zone (as exhausted Mana Orbs).'), 'output' => ''],
      156 => [clienttranslate('Create a [BRASSBUG] Robot token in each of your Expeditions.'), 'output' => ''],
      157 => [clienttranslate('Create two [ORDIS_RECRUIT] Soldier tokens in each of your Expeditions.'), 'output' => ''],
      158 => [clienttranslate('Draw three cards.'), 'output' => ''],
      159 => [
        clienttranslate(
          'Create four [ORDIS_RECRUIT] Soldier tokens, distributed as you choose among any number of target Expeditions.'
        ),
        'output' => '',
      ],
      160 => [clienttranslate('(unused) Target Expedition can\'t move forward this Day.'), 'output' => ''],
      161 => [clienttranslate('(unused) Target Expedition moves forward one Region.'), 'output' => ''],
      162 => [
        clienttranslate(
          '(unused) Reveal the top four cards of your Deck. Choose up to two Characters from these cards and put them in your Expeditions. They gain [FLEETING]. Discard the other cards.'
        ),
        'output' => '',
      ],
      163 => [clienttranslate('(unused) Expeditions can\'t move forward this Day.'), 'output' => ''],
      164 => [clienttranslate('(unused) You win the game.'), 'output' => ''],
      193 => [clienttranslate('[AFTER_YOU].'), 'output' => ''],
      194 => [clienttranslate('Tokens you control have [GIGANTIC].'), 'output' => ''],
      195 => [clienttranslate('Roll a die. On a 4+, I gain [ANCHORED]. On a 1-3, I gain 3 boosts.'), 'output' => ''],
      196 => [clienttranslate('Sacrifice one Character.'), 'output' => ''],
      197 => [clienttranslate('All Regions are {O} and lose their other types.'), 'output' => ''],
      199 => [clienttranslate('The next Spell you play this turn loses [FLEETING].'), 'output' => ''],
      200 => [clienttranslate('The next Character you play this turn loses [FLEETING].'), 'output' => ''],
      203 => [clienttranslate('[SABOTAGE]. (SP)'), 'output' => ''],
      204 => [clienttranslate('I have [SEASONED]. (OOF)'), 'output' => ''],
      205 => [
        clienttranslate('Up to one target Character with Hand Cost {3} or less other than me gains [ANCHORED]. (OOF)'),
        'output' => '',
      ],
      206 => [clienttranslate('Roll a die. On a 4+, I gain 2 boosts. On a 1-3, I gain 1 boost. (BR)'), 'output' => ''],
      207 => [clienttranslate('Roll a die. On a 4+, I gain 3 boosts. On a 1-3, I gain 1 boost. (BR)'), 'output' => ''],
      208 => [clienttranslate('Roll a die. On a 4+, draw a card. On a 1-3, [RESUPPLY]. (AX)'), 'output' => ''],
      209 => [clienttranslate('Roll a die. On a 4+, I gain [ANCHORED]. On a 1-3, I gain 3 boosts. (BR)'), 'output' => ''],
      210 => [clienttranslate('Each player draws a card. (OOF)'), 'output' => ''],
      211 => [clienttranslate('I gain [ANCHORED]. (1)'), 'output' => ''],
      212 => [clienttranslate('I gain [ANCHORED]. (2)'), 'output' => ''],
      213 => [clienttranslate('I gain [ANCHORED]. (3)'), 'output' => ''],
      214 => [clienttranslate('Characters your opponents play cost {1} more. (LY)'), 'output' => ''],
      215 => [clienttranslate('Create a [BRASSBUG] Robot token in each of your Expeditions. (BR)'), 'output' => ''],
      216 => [clienttranslate('Create a [BRASSBUG] Robot token in target Expedition. (BR)'), 'output' => ''],
      217 => [clienttranslate('Each Character controlled by target player gains [FLEETING]. (MU)'), 'output' => ''],
      218 => [clienttranslate('Each player may [RESUPPLY_INF]. (BR)'), 'output' => ''],
      219 => [
        clienttranslate('Each player puts the top card of their deck in their Mana zone (as an exhausted Mana Orb). (BR)'),
        'output' => '',
      ],
      220 => [clienttranslate('(unused) Each player sacrifices two Characters. (YZ)'), 'output' => ''],
      221 => [clienttranslate('I gain [ASLEEP]. (LY)'), 'output' => ''],
      222 => [clienttranslate('Sacrifice a Character in my Expedition. (OR)'), 'output' => ''],
      223 => [clienttranslate('Sacrifice one Character. (OR)'), 'output' => ''],
      224 => [clienttranslate('Sacrifice two Characters. (OR)'), 'output' => ''],
      225 => [clienttranslate('Target opponent discards a card from their hand. (AX)'), 'output' => ''],
      226 => [clienttranslate('The {j}, {h} and {r} triggers of Characters facing me don\'t activate. (BR)'), 'output' => ''],
      227 => [
        clienttranslate('(unused) You may discard any number of cards from your Reserve to draw that many cards. (AX)'),
        'output' => '',
      ],
      228 => [clienttranslate('You may put me in my owner\'s Mana zone (LY) (as an exhausted Mana Orb).'), 'output' => ''],
      229 => [
        clienttranslate('You may put me in my owner\'s Mana zone (LY) (as an exhausted Mana Orb). If you don\'t, draw a card.'),
        'output' => '',
      ],
      230 => [clienttranslate('Target opponent draws a card. (AX)'), 'output' => ''],
      232 => [clienttranslate('Create an [ORDIS_RECRUIT] Soldier token in my Expedition. (OOF)'), 'output' => ''],
      233 => [clienttranslate('Create an [ORDIS_RECRUIT] Soldier token in target Expedition. (OOF)'), 'output' => ''],
      234 => [clienttranslate('The next Character you play this turn gains 1 boost.'), 'output' => ''],
      235 => [clienttranslate('(unused) I have [GIGANTIC]. (BR)'), 'output' => ''],
      237 => [clienttranslate('[AFTER_YOU]. (LY)'), 'output' => ''],
      238 => [clienttranslate('Target Character gains [ANCHORED]. (BR)'), 'output' => ''],
      241 => [clienttranslate('The next Character you play this turn gains 2 boosts.'), 'output' => ''],
      242 => [clienttranslate('[RESUPPLY]. (sup)'), 'output' => ''],
      243 => [clienttranslate('I gain [FLEETING]. (1)'), 'output' => ''],
      244 => [clienttranslate('You may activate the {j} triggers of target Permanent you control. (sp)'), 'output' => ''],
      245 => [clienttranslate('Draw a card. (5+)'), 'output' => ''],
      246 => [clienttranslate('I have [GIGANTIC]. (7+)'), 'output' => ''],
      248 => [clienttranslate('You may return a card from your Reserve to your hand.'), 'output' => ''],
    ];
  }

  public static function constructEffect($trinity, &$properties)
  {
    $calculated = [];
    if (isset($trinity['trigger'])) {
      self::computeTrigger($trinity['trigger'], $calculated);
    }
    if (isset($trinity['condition'])) {
      self::computeConditions($trinity['condition'], $calculated);
    }
    // if (isset($trinity['output'])) {
    //   self::computeTrigger($trinity['output'], $calculated);
    // }

    $key = $calculated['type'];
    $node = [];
    if ($key != 'effectPassive') {
      // no natural condition check, we need to insert CheckConditions
      if (isset($calculated['triggerConditions'])) {
        self::insertCheckCondition($calculated['triggerConditions'], $node);
      }
      if (isset($calculated['conditionEffect'])) {
        self::addEffectToCondition($calculated['conditionEffect'], $node);
      }

      // TODO insert output
      // merge needs to be done
    } else {
      if (isset($calculated['trigger'])) {
        if (!is_array($calculated['trigger'])) {
          $calculated['trigger'] = [$calculated['trigger']];
        }

        $template = [];
        if (isset($calculated['triggerConditions'])) {
          $template['conditions'] = $calculated['triggerConditions'];
        }
        if (isset($calculated['conditionEffect'])) {
          $template['effect'] = $calculated['conditionEffect'];
        }

        foreach ($calculated['trigger'] as $t => $trig) {
          // add conditions + effect + output
          $node[$trig] = $template;
        }

        // insert output
        // output or attributes or passive effect
        // merge!
      }
    }
    $properties[$key] = $node;

    $properties[$key == 'effectSupport' ? 'supportDesc' : 'effectDesc'] = [
      $calculated['triggerDescription'] ?? '',
      $calculated['conditionDescription'] ?? '',
    ];
    if ($key == 'effectSupport') {
      if ($calculated['triggerDescription'] == '{D}') {
        $properties['supportIcon'] = 'discard';
      }
    }
    // debug
    //$properties['calculated'] = $calculated;

    // throw new \feException(print_r($properties));
    // use calculated to generate the effect in properties
    // if conditionEffect dans condition => noeud SEQ
    // Trigger condition => vrai check condition ! Array
    // le OUTPUT (s'il existe) doit être remplacé par l'output

    // TOOD: add description
  }

  public static function computeTrigger($effect, &$calculated)
  {
    $trigger = self::getTriggers()[$effect] ?? null;

    if (is_null($trigger)) {
      throw new \BgaVisibleSystemException('Unique trigger not implemented.' . $effect);
    }

    $calculated['type'] = $trigger['type'] ?? 'effectPassive';
    if (isset($trigger['trigger']) && $trigger['trigger'] != '') {
      $calculated['trigger'] = $trigger['trigger'];
    }
    if (isset($trigger['condition'])) {
      $calculated['triggerConditions'] = array_merge($calculated['triggerConditions'] ?? [], [$trigger['condition']]);
    }
    if (isset($trigger['description'])) {
      $calculated['triggerDescription'] = $trigger['description'];
    }
  }

  public static function computeConditions($effect, &$calculated)
  {
    $conditions = self::getConditions()[$effect] ?? null;

    if (is_null($conditions)) {
      throw new \BgaVisibleSystemException('Unique conditions not implemented.' . $effect);
    }
    if (isset($conditions['description'])) {
      $calculated['conditionDescription'] = $conditions['description'];
    }

    if (isset($conditions['condition'])) {
      $calculated['triggerConditions'] = array_merge($calculated['triggerConditions'] ?? [], [$conditions['condition']]);
    }

    if (isset($conditions['effect'])) {
      $calculated['conditionEffect'] = $conditions['effect'];
    }
  }

  public static function insertCheckCondition($conditions, &$node)
  {
    if (empty($node)) {
      $node = FT::ACTION(CHECK_CONDITION, ['conditions' => $conditions, 'effect' => 'TODO']);
    } else {
      $nKey = Utils::search($node, function ($child) {
        return ($child['action'] ?? '') == CHECK_CONDITION;
      });
      $node[$nKey]['conditions'] = array_merge(
        is_array($node[$nKey]['conditions']) ? $node[$nKey]['conditions'] : [$node[$nKey]['conditions']],
        $conditions
      );
    }
  }

  public static function addEffectToCondition($effect, &$node)
  {
    if (empty($node)) {
      $node = $effect;
    } else {
      $node = Utils::updateTree($node, 'TODO', $effect);
    }
  }

  // public static function getTrigger($effect){
  //   $trigger = null;
  //   switch ($effect) {
  //     case 2:

  //       break ;
  //   }
  // }
}
