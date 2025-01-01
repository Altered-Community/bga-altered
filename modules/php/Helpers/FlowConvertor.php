<?php

namespace ALT\Helpers;

use ALT\Core\Globals;
use ALT\Managers\Players;

// Allow to use a short flow description syntax
abstract class FlowConvertor
{
  public static function getTriggers()
  {
    return  [
      1 => ['description' => clienttranslate('{R}'), 'trigger' => '', 'type' => 'effectReserve'],
      2 => ['description' => clienttranslate('When an opponent draws one or more cards or does [RESUPPLY_T] —'), 'trigger' => ['Draw', 'Resupply', 'Morning'], 'condition' => ['isOpponentDraw', 'realResupply']],
      4 => ['description' => clienttranslate('When one of your Expeditions moves forward due to {V} —'), 'trigger' => 'AfterDusk', 'condition' => 'movesStormsWithForest', 'n' => 'eachExpedition'], // to check if bug with Rin
      5 => ['description' => clienttranslate('When a Robot joins your Expeditions —'), 'trigger' => ['ChooseAssignment', 'InvokeToken'], 'condition' => 'isCardPlayed:robot'],
      7 => ['description' => clienttranslate('When I go to Reserve from your hand —'), 'trigger' => 'Discard', 'condition' => 'isMyselfDiscarded:hand:reserve'],
      8 => ['description' => clienttranslate('When I\'m sacrificed —'), 'trigger' => 'Discard', 'condition' => 'isSacrificed'],
      10 => ['description' => clienttranslate('When you play a Permanent with Hand Cost {3} or more —'), 'trigger' => 'ChooseAssignment', 'condition' => 'isCardPlayed:permanent:3'],
      11 => ['description' => clienttranslate('When I go to Reserve from the Expedition zone —'), 'trigger' => 'LeaveExpedition', 'condition' => ['notFleeting', 'notDiscarded']],
      12 => ['description' => clienttranslate('When I leave the Expedition zone —'), 'trigger' => 'LeaveExpedition'],
      13 => ['description' => clienttranslate('When a Character you control gains 1 or more boosts —'), 'trigger' => 'Gain', 'condition' => 'isCharacterBoostedAndUntap'], // condition to check
      14 => ['description' => clienttranslate('When my Expedition fails to move forward during Dusk — After Rest:'), 'trigger' => 'AfterDusk', 'condition' => 'myExpeditionHasNotMoved', 'afterRest' => true],
      15 => ['description' => clienttranslate('When you play another Character with a base statistic of 0 —'), 'trigger' => 'ChooseAssignment', 'condition' => ['isCardPlayed::::true', 'isCardPlayedWithZeroStat']],
      16 => ['description' => clienttranslate('When you play a Permanent —'), 'trigger' => 'ChooseAssignment', 'condition' => 'isCardPlayed:permanent'],
      17 => ['description' => clienttranslate('At Dusk —'), 'trigger' => 'AtDusk'],
      19 => ['description' => clienttranslate('When another non-token Character joins your Expeditions —'), 'trigger' => 'ChooseAssignment', 'condition' => 'isCardPlayed:characterOnly:::true'],
      20 => ['description' => clienttranslate('At Noon —'), 'trigger' => 'Noon', 'condition' => 'isMe'],
      21 => ['description' => clienttranslate('When another Character joins your Expeditions —'), 'trigger' => ['ChooseAssignment', 'InvokeToken'], 'condition' => 'isCardPlayed:character:::true'],
      22 => ['description' => clienttranslate('{H}'), 'trigger' => '', 'type' => 'effectHand'],
      23 => ['description' => clienttranslate('[]]')],
      24 => ['description' => clienttranslate('{J}'), 'trigger' => '', 'type' => 'effectPlayed'],
      25 => ['description' => clienttranslate('When you create a token —'), 'trigger' => 'InvokeToken', 'condition' => 'isMe'],
      26 => ['description' => clienttranslate('When you roll one or more dice —'), 'trigger' => 'RollDie', 'condition' => 'isMe'],
      27 => ['description' => clienttranslate('When you play a Spell —'), 'trigger' => 'ChooseAssignment', 'condition' => 'isCardPlayed:spell'],
      28 => ['description' => clienttranslate('When a card leaves your Reserve during the Afternoon —'), 'trigger' => ['ChooseAssignment', 'Discard'], 'condition' => ['isAfternoon', 'hasSameOwner', 'isFromReserve', 'excludeSelf']],
      192 => ['description' => clienttranslate('{D}'), 'trigger' => '', 'type' => 'effectSupport'],
      231 => ['description' => clienttranslate('When I\'m sacrificed —'),  'trigger' => 'Discard', 'condition' => 'isSacrificed'],
      236 => ['description' => clienttranslate('When my Expedition fails to move forward during Dusk — After Rest:'), 'trigger' => 'AfterDusk', 'condition' => 'myExpeditionHasNotMoved', 'afterRest' => true],
      239 => ['description' => clienttranslate('When an opponent draws one or more cards or does [RESUPPLY_T] —'), 'trigger' => ['Draw', 'Resupply', 'Morning'], 'condition' => 'isOpponentDraw'],
      240 => ['description' => clienttranslate('When I gain 1 or more boosts —'), 'trigger' => 'Gain', 'condition' => 'hasGainedBoost'],
      // Alizé
      250 => ['description' => clienttranslate('When a card goes from your hand or deck to Reserve —'), 'trigger' => 'Discard', 'condition' => ['hasSameOwner', 'isDiscarded:hand:reserve']],
      253 => ['description' => clienttranslate('When another Character joins my Expedition —'), 'trigger' => ['ChooseAssignment', 'InvokeToken'], 'condition' => ['isCardAdded:character', 'isPlayedInSameLocation', 'excludeSelf']],
      419 => ['description' => clienttranslate('When another Character joins my Expedition —'), 'trigger' => ['ChooseAssignment', 'InvokeToken'], 'condition' => ['isCardAdded:character', 'isPlayedInSameLocation', 'excludeSelf']],
      263 => ['description' => clienttranslate('When another non-token Character joins one of your Expeditions that is behind —'), 'trigger' => 'ChooseAssignment', 'condition' => ['isCardAdded:characterOnly', 'cardPlayedExpeditionIsBehind', 'excludeSelf']],
      256 => ['description' => clienttranslate('When I gain <ASLEEP> —'), 'trigger' => 'Gain', 'condition' => 'hasGained:asleep'],
      257 => ['description' => clienttranslate('When I gain <FLEETING> —'), 'trigger' => 'Gain', 'condition' => 'hasGained:fleeting'],
      372 => ['description' => clienttranslate('When I leave the Expedition zone, if I was <FLEETING> —'), 'trigger' => 'LeaveExpedition', 'condition' => 'hasFleeting'],
      258 => ['description' => clienttranslate('When my Expedition moves forward —'), 'trigger' => 'AfterDusk', 'condition' => 'myExpeditionHasMoved'],
      259 => ['description' => clienttranslate('When my Expedition moves forward due to {V} —'), 'trigger' => 'AfterDusk', 'condition' => 'movesStormsWithForest'],
      260 => ['description' => clienttranslate('When you exhaust a card in Reserve —'), 'trigger' => 'Exhaust', 'condition' => 'isMe'],
      261 => ['description' => clienttranslate('When you play another Character in {V} —'), 'trigger' => 'ChooseAssignment', 'condition' => ['isMe', 'isCardAdded:character:::true', 'isPlayedCardInBiome:forest', 'excludeSelf']],

    ];
  }

  public static function getConditions()
  {
    return [
      166 => ['description' => clienttranslate('If you control two or more Plants other than me:'), 'condition' => 'hasControl:plant:2:true'],
      167 => ['description' => clienttranslate('If you have three or more base statistics of 0 among Characters you control:'), 'condition' => 'has3WithZeroStat'],
      168 => ['description' => clienttranslate('If I have 3 or more boosts:'), 'condition' => 'hasBoost:3'],
      169 => ['description' => clienttranslate('If you control two or more [BOOSTED_CHA_P] Characters:'), 'condition' => 'hasControl::2::boosted'],
      170 => [
        'description' => clienttranslate('You may discard one of your Mana Orbs. If you do:'),
        'effect' => FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetLocation' => [MANA],
          'upTo' => true,
          'targetType' => [CHARACTER, TOKEN, SPELL, PERMANENT],
          'effect' => FT::SEQ(FT::ACTION(DISCARD, []), 'OUTPUT')
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
            'effect' => FT::DISCARD_TO_RESERVE()
          ],
          ['optional' => true]
        ),
        'passiveEffect' => ['Discard' => ['condition' => ['isSource', 'isDiscarded:hand:reserve:permanent'], 'output' => 'OUTPUT']], // to check
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
        'passiveEffect' => ['Discard' => ['condition' => ['isSource', 'isDiscarded:hand:reserve:spell'], 'output' => 'OUTPUT']], // to check
      ],
      173 => ['description' => clienttranslate('If you control four or more Characters:'), 'condition' => 'hasControl::4'],
      175 => [
        'description' => clienttranslate('You may sacrifice a Permanent. If you do:'),
        'effect' =>  FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [PERMANENT],
          'upTo' => true,
          'effect' => FT::SEQ(FT::ACTION(DISCARD, ['desc' => 'sacrifice']), 'OUTPUT')
        ])
      ],
      176 => ['description' => clienttranslate('If you control two or more Landmarks:'), 'condition' => 'hasControl:landmark:2'],
      177 => [
        'description' => clienttranslate('Roll a die. On a 4+:'),
        'effect' => FT::ACTION(ROLL_DIE, [
          'effect' => ['4+' => 'OUTPUT'],
        ])
      ],
      178 => [
        'description' => clienttranslate('You may sacrifice a Character. If you do:'),
        'effect' =>  FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [TOKEN, CHARACTER],
          'upTo' => true,
          'effect' => FT::SEQ(FT::ACTION(DISCARD, ['desc' => 'sacrifice']), 'OUTPUT')
        ])
      ],
      179 => ['description' => clienttranslate('If you control three or more Characters:'), 'condition' => 'hasControl::3'],
      180 => [
        'description' => clienttranslate('You may sacrifice a Character or Permanent. If you do:'),
        'effect' =>  FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [TOKEN, CHARACTER, PERMANENT],
          'upTo' => true,
          'effect' => FT::SEQ(FT::ACTION(DISCARD, ['desc' => 'sacrifice']), 'OUTPUT')
        ])
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
            'effect' => FT::SEQ(FT::DISCARD_TO_RESERVE(), 'OUTPUT')
          ],
          ['optional' => true]
        ),
      ],
      183 => ['description' => clienttranslate('If I have 2 or more boosts:'), 'condition' => 'hasBoost:2'],
      186 => [
        'description' => clienttranslate('You may pay {1}. If you do:'),
        'effect' =>  FT::SEQ_OPTIONAL(FT::ACTION(PAY, ['pay' => 1]), 'OUTPUT'),
        'optional' => true
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
            'effect' => FT::SEQ(FT::ACTION(DISCARD, []), 'OUTPUT')
          ],
          ['optional' => true]
        )
      ],
      188 => ['description' => clienttranslate('If you control a token:'), 'condition' => 'hasControl:token:1'],
      189 => ['description' => clienttranslate('If you control one or more Landmarks:'), 'condition' => 'hasControl:landmark:1'],
      190 => ['description' => clienttranslate('If I\'m not [FLEETING]:'), 'condition' => 'notFleeting'],
      191 => ['description' => clienttranslate('[]]'),],
      198 => ['description' => clienttranslate('If you have less than eight Mana Orbs:'), 'condition' => 'hasLess8Mana'],
      201 => ['description' => clienttranslate('Unless you control two or more Plants other than me:'), 'condition' => 'hasControl:plant:1:true::LTE'],
      202 => ['description' => clienttranslate('Unless you control two or more Bureaucrats other than me:'), 'condition' => 'hasControl:bureaucrat:1:true::LTE'],
      247 => [
        'description' => clienttranslate('You may sacrifice me. If you do:'),
        'effect' => FT::SEQ_OPTIONAL(
          FT::ACTION(DISCARD, ['desc' => 'sacrifice', 'cardId' => ME]),
          'OUTPUT'
        )
      ],
      // Alizé
      354 => ['description' => clienttranslate('If each of your Expeditions is behind or tied:'), 'condition' => 'allExpeditionsAreBehindOrTied'],
      426 => ['description' => clienttranslate('If I\'m in {M}:'), 'condition' => 'isInBiome:mountain'],
      352 => ['description' => clienttranslate('If I\'m in {V}:'), 'condition' => 'isInBiome:forest'],
      405 => ['description' => clienttranslate('If I\'m in {V}:'), 'condition' => 'isInBiome:forest'],
      353 => ['description' => clienttranslate('If I\'m the only Character in my Expedition:'), 'condition' => 'XCharacterInExpedition:1:E'],
      378 => ['description' => clienttranslate('If I\'m the only Character in my Expedition:'), 'condition' => 'XCharacterInExpedition:1:E'],
      423 => ['description' => clienttranslate('If I\'m the only Character in my Expedition:'), 'condition' => 'XCharacterInExpedition:1:E'],
      355 => ['description' => clienttranslate('If my Expedition is behind:'), 'condition' => 'myExpeditionIsBehind'],
      383 => ['description' => clienttranslate('If my Expedition is behind:'), 'condition' => 'myExpeditionIsBehind'],
      357 => ['description' => clienttranslate('If there are no Characters in the Expedition I\'m played in:'), 'condition' => 'XCharacterInExpedition:0:E'],
      356 => ['description' => clienttranslate('If there are two or more exhausted cards in Reserve:'), 'condition' => 'hasXExhaustedReserve:2'],
      384 => ['description' => clienttranslate('If you control a <FLEETING> Character:'), 'condition' => 'hasControl::1:true:fleeting'],
      403 => ['description' => clienttranslate('If you control two or more Permanents:'), 'condition' => 'hasControl:permanent:2',],
      358 => ['description' => clienttranslate('If you have ten or more Mana Orbs:'), 'condition' => 'hasXMana:10'],
      359 => ['description' => clienttranslate('If you have two or more cards in Reserve:'), 'condition' => 'checkReserveCards:2'],
      361 => ['description' => clienttranslate('If your Companion Expedition is behind:'), 'condition' => 'companionExpeditionIsBehind'],
      362 => ['description' => clienttranslate('If your hand is empty:'), 'condition' => 'isHandEmpty'],
      364 => ['description' => clienttranslate('If your Hero Expedition is behind:'), 'condition' => 'heroExpeditionIsBehind'],
      367 => ['description' => clienttranslate('If your Reserve is empty:'), 'condition' => 'isReserveEmpty'],
      430 => [
        'description' => clienttranslate('Roll a die. On a 4+:'),
        'effect' => FT::ACTION(ROLL_DIE, [
          'effect' => ['4+' => 'OUTPUT'],
        ])
      ],
      368 => [
        'description' => clienttranslate('Sacrifice a Plant or Permanent. If you can\'t:'),
        'effect' => FT::XOR(
          FT::XOR(FT::ACTION(TARGET, [
            'targetPlayer' => ME,
            'targetType' => [CHARACTER],
            'subType' => PLANT,
            'excludeSelf' => true,
            'n' => 1,
            'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
          ]), FT::ACTION(TARGET, [
            'targetPlayer' => ME,
            'targetType' => [PERMANENT],
            'excludeSelf' => true,
            'n' => 1,
            'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
          ]),),
          FT::ACTION(CHECK_CONDITION, ['condition' => 'noPlantnoPermanent', 'effect' => 'OUTPUT'])
        )
      ],
      369 => [
        'description' => clienttranslate('Sacrifice another Robot or Permanent. If you can\'t:'),
        'effect' => FT::XOR(
          FT::XOR(FT::ACTION(TARGET, [
            'targetPlayer' => ME,
            'targetType' => [CHARACTER],
            'subType' => ROBOT,
            'excludeSelf' => true,
            'n' => 1,
            'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
          ]), FT::ACTION(TARGET, [
            'targetPlayer' => ME,
            'targetType' => [PERMANENT],
            'excludeSelf' => true,
            'n' => 1,
            'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
          ]),),
          FT::ACTION(CHECK_CONDITION, ['condition' => 'noRobotnoPermanent', 'effect' => 'OUTPUT'])
        )
      ],
      371 => ['description' => clienttranslate('Unless I\'m in {O}:'), 'condition' => 'isNotInBiome:ocean'],
      425 => ['description' => clienttranslate('Unless you control two or more Landmarks:'), 'condition' => 'hasControl:landmark:1:false:all:LTE'],
      373 => [
        'description' => clienttranslate('You may discard a Character from your Reserve. If you do:'),
        'effect' => FT::ACTION(
          TARGET,
          [
            'targetType' => [CHARACTER],
            'targetPlayer' => ME,
            'targetLocation' => [RESERVE],
            'upTo' => true,
            'effect' => FT::SEQ(FT::ACTION(DISCARD, []), 'OUTPUT')
          ],
          ['optional' => true]
        )
      ],
      374 => [
        'description' => clienttranslate('You may discard a Spell from your Reserve. If you do:'),
        'effect' => FT::ACTION(
          TARGET,
          [
            'targetType' => [SPELL],
            'targetPlayer' => ME,
            'targetLocation' => [RESERVE],
            'upTo' => true,
            'effect' => FT::SEQ(FT::ACTION(DISCARD, []), 'OUTPUT')
          ],
          ['optional' => true]
        )
      ],
      375 => [
        'description' => clienttranslate('You may have me gain <FLEETING>. If you do:'),
        'effect' => FT::SEQ_OPTIONAL(FT::GAIN(ME, FLEETING), 'OUTPUT')
      ],
      385 => [
        'description' => clienttranslate('You may have me gain <FLEETING>. If you do:'),
        'effect' => FT::SEQ_OPTIONAL(FT::GAIN(ME, FLEETING), 'OUTPUT')
      ],
      376 => [
        'description' => clienttranslate('You may ready an exhausted card in Reserve. If you do:'),
        'effect' =>
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'targetLocation' => [RESERVE],
          'isTapped' => true,
          'upTo' => true,
          'effect' => FT::SEQ(FT::ACTION(READY, []), 'OUTPUT')
        ]),
      ],
      370 => [
        'description' => clienttranslate('You may sacrifice another Robot or Permanent. If you do:'),
        'effect' => FT::XOR(
          FT::ACTION(TARGET, [
            'targetPlayer' => ME,
            'targetType' => [CHARACTER],
            'subType' => ROBOT,
            'excludeSelf' => true,
            'n' => 1,
            'effect' => FT::SEQ(FT::ACTION(DISCARD, ['desc' => 'sacrifice']), 'OUTPUT')
          ]),
          FT::ACTION(TARGET, [
            'targetPlayer' => ME,
            'targetType' => [PERMANENT],
            'excludeSelf' => true,
            'n' => 1,
            'effect' => FT::SEQ(FT::ACTION(DISCARD, ['desc' => 'sacrifice']), 'OUTPUT')
          ]),
        ),
      ],

    ];
  }

  public static function getOutput()
  {
    return [
      29 => [
        'description' => clienttranslate('Sacrifice two Characters.'),
        'output' => FT::ACTION(
          TARGET,
          [
            'targetPlayer' => ME,
            'targetType' => [CHARACTER, TOKEN],
            'n' => 2,
            'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice'])
          ]
        )
      ],
      30 => ['description' => clienttranslate('Target opponent draws a card.'), 'output' =>  FT::ACTION(DRAW, ['players' => OPPONENT])],
      31 => ['description' => clienttranslate('I can\'t be played if you have less than seven Mana Orbs.'), 'attributes' => ['minManaOrbs' => 7]],
      32 => ['description' => clienttranslate('I am <DEFENDER>.'), 'noTrigger' => true, 'attributes' => ['dynamicDefender' => 'fullDefender']],
      33 => ['description' => clienttranslate('I gain <ASLEEP>.'), 'output' => FT::GAIN(ME, ASLEEP)],
      34 => ['description' => clienttranslate('I gain <FLEETING>.'), 'output' => FT::GAIN(ME, FLEETING)],
      35 => ['description' => clienttranslate('I can\'t be played if you have less than six Mana Orbs.'), 'attributes' => ['minManaOrbs' => 6]],
      36 => [
        'description' => clienttranslate('Sacrifice a Character in my Expedition.'),
        'output' =>  FT::ACTION(
          TARGET,
          [
            'targetPlayer' => ME,
            'targetType' => [CHARACTER, TOKEN],
            'targetLocation' => ['source'],
            'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice'])
          ]
        ),
      ],
      37 => ['description' => clienttranslate('I lose $<FLEETING>.'), 'output' => FT::LOOSE(ME, FLEETING)],
      38 => [
        'description' => clienttranslate('You may play me for free and I gain <ASLEEP>.'),
        'output' => FT::SEQ_OPTIONAL(
          FT::ACTION(PLAY_CARD, ['cardId' => ME, 'free' => true]),
          FT::GAIN(ME, ASLEEP)
        ),
      ],
      39 => ['description' => clienttranslate('Each player draws a card.'), 'output' =>  FT::ACTION(DRAW, [])],
      40 => ['description' => clienttranslate('Each player puts the top card of their deck in their Mana zone (as an exhausted Mana Orb).'), 'output' => FT::ACTION(DRAW, ['location' => MANA, 'tapped' => true])],
      41 => [
        'description' => clienttranslate('You may put a card from your hand in Reserve.'),
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
        'description' => clienttranslate('You may have target Character other than me lose <FLEETING>.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, TOKEN],
          'excludeSelf' => true,
          'targetLocation' => STORMS,
          'upTo' => true,
          'effect' => FT::LOOSE(EFFECT, FLEETING),
        ]),
      ],
      43 => ['description' => clienttranslate('Each player may <RESUPPLY_INF>.'), 'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'eachPlayerOptionalResupply'])],
      44 => ['description' => clienttranslate('Put me in Reserve.'), 'output' => FT::ACTION(DISCARD, ['destination' => RESERVE, 'cardId' => ME])],
      45 => ['description' => clienttranslate('The {j}, {h} and {r} abilities of Characters facing me can\'t activate.'), 'noTrigger' => true, 'attributes' => ['dynamicBlockingPower' => 'block']],
      46 => ['description' => clienttranslate('I have <SEASONED>.'), 'attributes' => ['seasoned' => true]],
      47 => ['description' => clienttranslate('I have <TOUGH_1>.'), 'noTrigger' => true, 'attributes' => ['dynamicTough' => 'tough1']],
      48 => ['description' => clienttranslate('If you would roll one or more dice, instead roll that many dice plus one and ignore the roll of your choice.'), 'attributes' => ['addDice' => 1]],
      49 => ['description' => clienttranslate('If you would roll a die, you may add 1 to its result. (Choose after you see the result.)'), 'attributes' => ['addRoll' => 1]],
      50 => ['description' => clienttranslate('I have <TOUGH_X>, where X is the number of regions between your Hero and Companion.'), 'noTrigger' => true, 'attributes' => ['dynamicTough' => 'region']],
      51 => ['description' => clienttranslate('<RESUPPLY>.'), 'output' => FT::ACTION(RESUPPLY, []),],
      52 => [
        'description' => clienttranslate('You may return a Spell from your Reserve to your hand.'),
        'output' =>  FT::ACTION(
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
      54 => ['description' => clienttranslate('I have <TOUGH_2>.'),  'noTrigger' => true, 'attributes' => ['dynamicTough' => 'tough2']],
      56 => ['description' => clienttranslate('I gain 1 boost.'), 'output' => FT::GAIN(ME, BOOST)],
      57 => [
        'description' => clienttranslate('The next Permanent you play this Afternoon costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 1, 'permanent' => true]],
        ],
      ],
      58 => [
        'description' => clienttranslate('The next Plant you play this Afternoon costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => PLANT, 'reduction' => 1, 'permanent' => true]],
        ],
      ],
      59 => [
        'description' => clienttranslate('The next Spell you play this Afternoon costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => SPELL, 'reduction' => 1, 'permanent' => true]],
        ],
      ],
      60 => [
        'description' => clienttranslate('The next Character you play from your hand this turn activates its {r} abilities (as if it had been played from Reserve).'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'triggerEffectOfNextCharacter', 'args' => ['type' => CHARACTER, 'from' => HAND, 'effect' => RESERVE]]),
      ],
      61 => [
        'description' => clienttranslate('You may return a card other than me from your Reserve to your hand.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
          'excludeSelf' => true,
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::RETURN_TO_HAND()
        ]),
      ],
      63 => [
        'description' => clienttranslate('The next Bureaucrat you play this Afternoon costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => BUREAUCRAT, 'reduction' => 1, 'permanent' => true]],
        ],
      ],
      64 => [
        'description' => clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in my Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => ['source'],
        ]),
      ],
      65 => [
        'description' => clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in your Companion Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => [STORM_RIGHT],
        ]),
      ],
      66 => [
        'description' => clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in your Hero Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => [STORM_LEFT],
        ]),
      ],
      67 => [
        'description' => clienttranslate('Plants you control other than me gain 1 boost.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostAllSubtype', 'args' => ['excludeSelf' => true, 'subType' => PLANT]]),
      ],
      68 => [
        'description' =>  clienttranslate('Roll a die. On a 4+, I gain 2 boosts. On a 1-3, I gain 1 boost.'),
        'output' =>  FT::ACTION(ROLL_DIE, [
          'effect' => ['1-3' => FT::GAIN(ME, BOOST, 1), '4+' => FT::GAIN(ME, BOOST, 2)],
        ]),
      ],
      69 => [
        'description' => clienttranslate('Up to one target Character gains <ASLEEP>.'),
        'output' => FT::ACTION(TARGET, [
          'upTo' => true,
          'targetType' => [CHARACTER, TOKEN],
          'effect' => FT::GAIN(EFFECT, ASLEEP)
        ]),
      ],
      70 => [
        'description' => clienttranslate('Up to one target Character gains <FLEETING>.'),
        'output' => FT::ACTION(TARGET, [
          'upTo' => true,
          'targetType' => [CHARACTER, TOKEN],
          'effect' => FT::GAIN(EFFECT, FLEETING)
        ]),
      ],
      71 => ['description' => clienttranslate('Reduce my cost by {1}.'), 'noTrigger' => true, 'attributes' => ['dynamicCostReduction' => '1']],
      72 => ['description' => clienttranslate('If you would <RESUPPLY_INF>, instead look at the top two cards of your deck. Put one in Reserve, and discard the other.'), 'attributes' => ['resupply2' => true]],
      73 => [
        'description' => clienttranslate('Characters you control other than me have <TOUGH_1>.'),
        'noTrigger' => true,
        'attributes' => ['dynamicTough' => 'universalCharacter1', 'excludeUniversalTough' => true]
      ],
      75 => [
        'description' => clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in your other Expedition (the one I\'m not in).'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => ['oppositeSource'],
        ]),
      ],
      76 => [
        'description' => clienttranslate('Robots you control other than me gain 1 boost.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostAllSubtype', 'args' => ['subType' => ROBOT, 'excludeSelf' => true]])
      ],
      77 => [
        'description' => clienttranslate('Target Character gains 1 boost.'),
        'output' => FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST])])
      ],
      78 => [
        'description' => clienttranslate('Target Character switches Expedition.'),
        'output' => FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'effect' => FT::ACTION(MOVE_CARD, [])]),
      ],
      79 => [
        'description' => clienttranslate('The next card you play this Afternoon costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => ALL, 'permanent' => true, 'reduction' => 1]],
        ],
      ],
      80 => [
        'description' => clienttranslate('<SABOTAGE>.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
      ],
      81 => [
        'description' => clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in target Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
        ]),
      ],
      82 => [
        'description' => clienttranslate('I gain 1 boost for each card in your Reserve.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXReserve']),
      ],
      83 => [
        'description' => clienttranslate('Roll a die. On a 4+, draw a card. On a 1-3, <RESUPPLY>.'),
        'output' => FT::ACTION(ROLL_DIE, [
          'effect' => [
            '1-3' => FT::ACTION(RESUPPLY, []),
            '4+' => FT::ACTION(DRAW, ['players' => ME]),
          ],
        ]),
      ],
      84 => [
        'description' =>  clienttranslate('Your Characters have: \"{R} I gain 1 boost.\"'),
        'passive' => [
          'ChooseAssignment' => [
            'condition' => 'isCharacterFromReserveNotBlocked',
            'output' => FT::GAIN(EFFECT, BOOST),
          ],
        ],
      ],
      86 => [
        'description' =>  clienttranslate('I gain 1 boost for each Landmark you control.'),
        'output' =>  FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXLandmark']),
      ],
      87 => [
        'description' => clienttranslate('You may activate the {j} abilities of target Permanent you control.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [PERMANENT],
          'targetPlayer' => ME,
          'hasEffects' => ['Played'],
          'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
        ]),
      ],
      88 => [
        'description' => clienttranslate('You may have target Character other than me lose [FLEETING] and gain 1 boost.'),
        'output' => FT::ACTION(
          TARGET,
          [
            'upTo' => true,
            'excludeSelf' => true,
            'effect' => FT::SEQ(
              FT::LOOSE(EFFECT, FLEETING),
              FT::GAIN(EFFECT, BOOST)
            )
          ]
        ),
      ],
      89 => [
        'description' =>  clienttranslate('Each player sacrifices a Character.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'AllPlayersSacrifice1'])
      ],
      90 => ['description' => clienttranslate('Draw a card.'), 'output' => FT::ACTION(DRAW, ['players' => ME])],
      91 => [
        'description' =>  clienttranslate('Up to one target Character gains <ASLEEP>. You may have it gain 2 boosts.'),
        'output' => FT::ACTION(TARGET, [
          'upTo' => true,
          'effect' => FT::XOR(
            FT::GAIN(EFFECT, ASLEEP),
            FT::SEQ(
              FT::GAIN(EFFECT, ASLEEP),
              FT::GAIN(EFFECT, BOOST, 2)
            )
          )
        ]),
      ],
      92 => [
        'description' => clienttranslate('Each Character controlled by target player gains <FLEETING>.'),
        'output' => FT::ACTION(TARGET_PLAYER, ['opponentsOnly' => false, 'effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'fleetingAllCharacters'])])
      ],
      94 => [
        'description' => clienttranslate('Up to one target Character with Hand Cost {3} or less other than me gains <ANCHORED>.'),
        'output' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'excludeSelf' => true, 'upTo' => true, 'effect' => FT::GAIN(EFFECT, ANCHORED)]),
      ],
      95 => ['description' => clienttranslate('Characters your opponents play cost {1} more.'), 'noTrigger' => true, 'attributes' => ['increaseOpponentCharacterCost' => '1']],
      96 => [
        'description' => clienttranslate('Put me in my owner\'s Mana zone (as an exhausted Mana Orb).'),
        'output' => FT::ACTION(
          DISCARD,
          ['cardId' => ME, 'destination' => MANA, 'tapped' => true, 'force' => true]
        ),
      ],
      97 => ['description' => clienttranslate('I gain 2 boosts.'), 'output' => FT::GAIN(ME, BOOST, 2),],
      98 => [
        'description' => clienttranslate('You may return target Character or Permanent with Hand Cost {4} or less to its owner\'s hand.'),
        'output' => FT::ACTION(TARGET, ['maxHandCost' => 4, 'upTo' => true, 'targetType' => [CHARACTER, TOKEN, PERMANENT], 'effect' => FT::RETURN_TO_HAND()])
      ],
      99 => [
        'description' => clienttranslate('Roll a die. On a 4+, I gain 3 boosts. On a 1-3, I gain 1 boost.'),
        'output' => FT::ACTION(ROLL_DIE, [
          'effect' => ['1-3' => FT::GAIN(ME, BOOST, 1), '4+' => FT::GAIN(ME, BOOST, 3)],
        ]),
      ],
      100 => ['description' => clienttranslate('Target Character gains [ANCHORED].'), 'output' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, ANCHORED)]),],
      101 => [
        'description' => clienttranslate('Target Character in your other Expedition (the one I\'m not in) gains 2 boosts.'),
        'output' => FT::ACTION(TARGET, [
          'targetLocation' => ['oppositeSource'],
          'targetPlayer' => ME,
          'effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])
        ]),
      ],
      102 => [
        'description' => clienttranslate('The next Permanent you play this Afternoon costs {2} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 2, 'permanent' => true]],
        ],
      ],
      104 => [
        'description' => clienttranslate('You may discard target Permanent with Hand Cost {4} or more.'),
        'output' =>  FT::ACTION(TARGET, ['minHandCost' => 4, 'upTo' => true, 'targetType' => [PERMANENT], 'effect' => FT::ACTION(DISCARD, [])]),
      ],
      105 => [
        'description' => clienttranslate('You may put me in my owner\'s Mana zone (as an exhausted Mana Orb).'),
        'output' => FT::ACTION(
          DISCARD,
          ['cardId' => ME, 'destination' => MANA, 'tapped' => true, 'canPass' => true, 'force' => true]
        ),
      ],
      106 => ['description' => clienttranslate('I gain 2 boosts and lose <FLEETING>.'), 'output' => FT::SEQ(FT::GAIN(ME, BOOST, 2), FT::LOOSE(ME, FLEETING)),],
      107 => [
        'description' => clienttranslate('Create two <ORDIS_RECRUIT> Soldier tokens in my Expedition.'),
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
        'description' => clienttranslate('I gain 1 boost for each card in each player\'s Reserve.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXReserveAll']),
        'attributes' => ['blockAutomaticAction' => [GAIN => [BOOST => 1]]]
      ],
      109 => [
        'description' => clienttranslate('Up to one target Plant gains 2 boosts.'),
        'output' => FT::ACTION(TARGET, [
          'upTo' => true,
          'subType' => PLANT,
          'effect' => FT::GAIN(EFFECT, BOOST, 2)
        ]),
      ],
      110 => ['description' => clienttranslate('I gain <ANCHORED>.'), 'output' => FT::GAIN(ME, ANCHORED)],
      111 => [
        'description' => clienttranslate('Put the top card of your deck in your Mana zone (as an exhausted Mana Orb).'),
        'output' => FT::ACTION(DRAW_MANA, []),
      ],
      112 => ['description' => clienttranslate('Cards your opponents play can\'t cost less than {2}.'), 'noTrigger' => true, 'attributes' => ['opponentCardsMinimumCost' => '2']],
      113 => [
        'description' => clienttranslate('You may activate the {j} abilities of up to two target Permanents you control.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [PERMANENT],
          'targetPlayer' => ME,
          'upTo' => true,
          'n' => 2,
          'hasEffects' => ['Played'],
          'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
        ]),
      ],
      114 => ['description' => clienttranslate('Reduce my cost by {2}.'), 'noTrigger' => true, 'attributes' => ['dynamicCostReduction' => '2']],
      115 => [
        'description' => clienttranslate('You may return target Character or Permanent with Hand Cost {5} or less to its owner\'s hand.'),
        'output' => FT::ACTION(TARGET, ['maxHandCost' => 5, 'upTo' => true, 'targetType' => [CHARACTER, TOKEN, PERMANENT], 'effect' => FT::RETURN_TO_HAND()])
      ],
      116 => [
        'description' => clienttranslate('Target Character other than me gains [FLEETING], [ANCHORED] or [ASLEEP].'),
        'output' => FT::ACTION(
          TARGET,
          [
            'excludeSelf' => true,
            'effect' => FT::XOR(
              FT::GAIN(EFFECT, FLEETING),
              FT::GAIN(EFFECT, ANCHORED),
              FT::GAIN(EFFECT, ASLEEP)
            )
          ]
        ),
      ],
      117 => [
        'description' => clienttranslate('Characters you control other than me have <TOUGH_2>.'),
        'attributes' => ['excludeUniversalTough' => true, 'dynamicTough' => 'universalCharacter2',]
      ],
      118 => [
        'description' => clienttranslate('Create a <BRASSBUG> Robot token in target Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'AX_Common_Brassbug',
          'targetLocation' => STORMS,
        ]),
      ],
      119 => [
        'description' => clienttranslate('Target Character gains 2 boosts.'),
        'output' => FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])]),
      ],
      120 => [
        'description' => clienttranslate('Up to two target Characters each gain 1 boost.'),
        'output' => FT::ACTION(TARGET, ['upTo' => true, 'n' => 2, 'effect' => FT::ACTION(GAIN, ['type' => BOOST])]),
      ],
      121 => [
        'description' => clienttranslate('You may send to Reserve target Character with Hand Cost {X} or less, where X is the number of Characters you control.'),
        'output' => FT::ACTION(TARGET, ['maxHandCost' => 'controlledCharacter', 'upTo' => true, 'effect' => FT::DISCARD_TO_RESERVE()])
      ],
      122 => [
        'description' => clienttranslate('You may put me in my owner\'s Mana zone (as an exhausted Mana Orb). If you don\'t, draw a card.'),
        'output' => FT::XOR(
          FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => MANA, 'force' => true, 'tapped' => true]),
          FT::ACTION(DRAW, ['players' => ME])
        )
      ],
      123 => ['description' => clienttranslate('I am <GIGANTIC>.'), 'attributes' => ['gigantic' => true]],
      124 => [
        'description' => clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in each of your Expeditions.'),
        'output' =>  FT::SEQ(
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => [STORM_RIGHT],
          ]),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => [STORM_LEFT],
          ])
        ),
      ],
      125 => [
        'description' => clienttranslate('Each player discards their hand, then draws three cards.'),
        'output' => FT::SEQ(FT::ACTION(SPECIAL_EFFECT, ['effect' => 'discardAllHand']), FT::ACTION(DRAW, ['n' => 3])),
      ],
      127 => [
        'description' => clienttranslate('For each Character you control other than me, you may activate its {j} triggers.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'activateAllOtherCharacters']),
      ],
      128 => [
        'description' => clienttranslate('For each Permanent you control, you may activate its {j} triggers.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'activateAllPermanents'])
      ],
      129 => [
        'description' => clienttranslate('You may send to Reserve target Character with Hand Cost {3} or less.'),
        'output' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'upTo' => true, 'effect' => FT::DISCARD_TO_RESERVE()]),
      ],
      130 => [
        'description' => clienttranslate('Target opponent discards a card from their hand.'),
        'output' => FT::ACTION(TARGET_PLAYER, ['effect' =>  FT::ACTION(
          TARGET,
          [
            'targetPlayer' => ME,
            'targetLocation' => [HAND],
            'targetType' => [CHARACTER, SPELL, PERMANENT],
            'effect' => FT::ACTION(DISCARD, []),
          ]
        )])
      ],
      131 => ['description' => clienttranslate('Your other Expedition (the one I\'m not in) and the Expedition facing it can\'t move forward.'), 'noTrigger' => true, 'attributes' => ['dynamicOppositeDefender' => 't']], // value is not relevant :)
      132 => [
        'description' => clienttranslate('You may discard target Permanent.'),
        'output' => FT::ACTION(TARGET, ['targetType' => [PERMANENT], 'upTo' => true, 'effect' => FT::ACTION(DISCARD, [])]),
      ],
      133 => [
        'description' => clienttranslate('Characters you control gain 1 boost.'),
        'output' => FT::ACTION(
          TARGET,
          ['targetPlayer' => ME, 'n' => INFTY, 'effect' => FT::GAIN(EFFECT, BOOST)]
        ),
      ],
      134 => ['description' => clienttranslate('I gain 3 boosts.'), 'output' => FT::GAIN(ME, BOOST, 3)],
      136 => [
        'description' => clienttranslate('You may send to Reserve target Character with Hand Cost {4} or more.'),
        'output' =>  FT::ACTION(TARGET, ['minHandCost' => 4, 'upTo' => true, 'effect' => FT::DISCARD_TO_RESERVE()]),
      ],
      137 => [
        'description' => clienttranslate('You may discard target Character with Hand Cost {3} or less.'),
        'output' =>  FT::ACTION(TARGET, ['maxHandCost' => 3, 'upTo' => true, 'effect' => FT::ACTION(DISCARD, [])]),
      ],
      138 => [
        'description' => clienttranslate('You may discard target <FLEETING>, <ANCHORED>, or <ASLEEP> Character.'),
        'output' =>  FT::ACTION(TARGET, [
          'statuses' => [FLEETING, ANCHORED, ASLEEP],
          'targetType' => [CHARACTER, TOKEN],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
      ],
      139 => [
        'description' => clienttranslate('You may put target Character or Permanent in its owner\'s Mana zone (as an exhausted Mana Orb).'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [PERMANENT, CHARACTER],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, ['destination' => MANA, 'tapped' => true]),
        ])
      ],
      140 => [
        'description' => clienttranslate('Roll a die. I gain X boosts, where X is the result.'),
        'output' =>  FT::ACTION(ROLL_DIE, [
          'effect' => ['1+' => FT::GAIN(ME, BOOST, 'die')],
        ]),
      ],
      141 => [
        'description' => clienttranslate('You may discard target Character with Hand Cost {4} or more.'),
        'output' => FT::ACTION(TARGET, ['minHandCost' => 4, 'upTo' => true, 'effect' => FT::ACTION(DISCARD, [])]),
      ],
      142 => ['description' => clienttranslate('I am <ETERNAL>.'), 'noTrigger' => true, 'attributes' => ['dynamicEternal' => '1']],
      143 => [
        'description' => clienttranslate('Each player discards their hand and their Reserve, then draws three cards.'),
        'output' => FT::SEQ(FT::ACTION(SPECIAL_EFFECT, ['effect' => 'discardAllHandReserve']), FT::ACTION(DRAW, ['n' => 3])),
      ],
      144 => [
        'description' => clienttranslate('You may send target Character to Reserve.'),
        'output' =>  FT::ACTION(TARGET, ['upTo' => true, 'effect' => FT::DISCARD_TO_RESERVE()]),
      ],
      145 => [
        'description' => clienttranslate('Roll a die. Target Character gain X boosts, where X is the result.'),
        'output' =>  FT::ACTION(ROLL_DIE, [
          'effect' => ['1+' => FT::ACTION(TARGET, ['effect' => FT::GAIN('effect', BOOST, 'die')])],
        ]),
      ],
      146 => [
        'description' => clienttranslate('Target Character gains 3 boosts.'),
        'output' => FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 3])]),
      ],
      147 => [
        'description' => clienttranslate('You may discard target Character.'),
        'output' => FT::ACTION(TARGET, ['targetType' => [TOKEN, CHARACTER], 'upTo' => true, 'effect' => FT::ACTION(DISCARD, [])]),
      ],
      148 => [
        'description' => clienttranslate('All Characters in target Expedition gain <ASLEEP>.'),
        'output' => FT::ACTION(TARGET_EXPEDITION, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'sleepingAllCharactersinExpedition'])])
      ],
      149 => [
        'description' => clienttranslate('Your opponent\'s Expedition facing me moves backwards one region.'),
        'output' =>  FT::ACTION(MOVE_EXPEDITION, ['n' => -1, 'expedition' => [EFFECT], 'pId' => OPPONENT]),
      ],
      150 => [
        'description' => clienttranslate('You may return target Character or Permanent to the top of its owner\'s deck.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, TOKEN, PERMANENT],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, ['destination' => 'topOfDeck']),
        ])
      ],
      151 => [
        'description' => clienttranslate('Up to two target Characters each gain 2 boosts.'),
        'output' =>  FT::ACTION(TARGET, [
          'upTo' => true,
          'n' => 2,
          'effect' => FT::GAIN(EFFECT, BOOST, 2)
        ]),
      ],
      152 => ['description' => clienttranslate('Draw two cards.'), 'output' => FT::ACTION(DRAW, ['n' => 2, 'players' => ME])],
      154 => [
        'description' => clienttranslate('You may discard target Character or Permanent.'),
        'output' =>  FT::ACTION(TARGET, ['targetType' => [PERMANENT, CHARACTER, TOKEN], 'upTo' => true, 'effect' => FT::ACTION(DISCARD, [])]),
      ],
      155 => [
        'description' => clienttranslate('Put the top two cards of your deck in your Mana zone (as exhausted Mana Orbs).'),
        'output' => FT::ACTION(DRAW_MANA, ['n' => 2]),
      ],
      156 => [
        'description' => clienttranslate('Create a <BRASSBUG> Robot token in each of your Expeditions.'),
        'output' =>  FT::SEQ(
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'AX_Common_Brassbug',
            'targetLocation' => [STORM_RIGHT],
          ]),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'AX_Common_Brassbug',
            'targetLocation' => [STORM_LEFT],
          ])
        ),
      ],
      157 => [
        'description' => clienttranslate('Create two <ORDIS_RECRUIT> Soldier tokens in each of your Expeditions.'),
        'output' => FT::SEQ(
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => [STORM_RIGHT],
          ]),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => [STORM_RIGHT],
          ]),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => [STORM_LEFT],
          ]),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => [STORM_LEFT],
          ])
        ),
      ],
      158 => ['description' => clienttranslate('Draw three cards.'), 'output' => FT::ACTION(DRAW, ['n' => 3, 'players' => ME])],
      159 => [
        'description' => clienttranslate('Create four <ORDIS_RECRUIT> Soldier tokens, distributed as you choose among any number of target Expeditions.'),
        'output' => FT::SEQ(
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => STORMS,
          ]),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => STORMS,
          ]),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => STORMS,
          ]),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => STORMS,
          ])
        ),
      ],
      193 => ['description' => clienttranslate('<AFTER_YOU>.'), 'output' => FT::ACTION(AFTER_YOU, []),],
      194 => ['description' => clienttranslate('Tokens you control are <GIGANTIC>.'), 'noTrigger' => true, 'attributes' => ['dynamicGigantic' => 'universalGiganticToken']],
      195 => [
        'description' => clienttranslate('Roll a die. On a 4+, I gain <ANCHORED>. On a 1-3, I gain 3 boosts.'),
        'output' => FT::ACTION(ROLL_DIE, [
          'effect' => ['1-3' => FT::GAIN(ME, BOOST, 3), '4+' => FT::GAIN(ME, ANCHORED)],
        ]),
      ],
      196 => [
        'description' => clienttranslate('Sacrifice one Character.'),
        'output' => FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [CHARACTER, TOKEN],
          'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
        ]),
      ],
      197 => [
        'description' => clienttranslate('All Regions are {O} and lose their other types.'),
        'attributes' => ['updateExpeditions' => ['type' => 'all', 'regionsRemove' => [MOUNTAIN, FOREST], 'regionsAdd' => [OCEAN]]]
      ],
      199 => [
        'description' => clienttranslate('The next Spell you play this turn loses <FLEETING>.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'removeFleetingSpellPlayed'])
      ],
      200 => [
        'description' => clienttranslate('The next Character you play this turn loses <FLEETING>.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'removeFleetingCharacterPlayed']),
      ],
      203 => [
        'description' => clienttranslate('<SABOTAGE>.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
      ],
      204 => ['description' => clienttranslate('I have <SEASONED>. (OOF)'), 'attributes' => ['seasoned' => true]],
      205 => [
        'description' => clienttranslate('Up to one target Character with Hand Cost {3} or less other than me gains <ANCHORED>.'),
        'output' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'excludeSelf' => true, 'upTo' => true, 'effect' => FT::GAIN(EFFECT, ANCHORED)]),
      ],
      206 => [
        'description' => clienttranslate('Roll a die. On a 4+, I gain 2 boosts. On a 1-3, I gain 1 boost.'),
        'output' => FT::ACTION(ROLL_DIE, [
          'effect' => ['1-3' => FT::GAIN(ME, BOOST, 1), '4+' => FT::GAIN(ME, BOOST, 2)],
        ]),
      ],
      207 => [
        'description' => clienttranslate('Roll a die. On a 4+, I gain 3 boosts. On a 1-3, I gain 1 boost.'),
        'output' => FT::ACTION(ROLL_DIE, [
          'effect' => ['1-3' => FT::GAIN(ME, BOOST, 1), '4+' => FT::GAIN(ME, BOOST, 3)],
        ]),
      ],
      208 => [
        'description' => clienttranslate('Roll a die. On a 4+, draw a card. On a 1-3, <RESUPPLY>.'),
        'output' => FT::ACTION(ROLL_DIE, [
          'effect' => [
            '1-3' => FT::ACTION(RESUPPLY, []),
            '4+' => FT::ACTION(DRAW, ['players' => ME]),
          ],
        ]),
      ],
      209 => [
        'description' => clienttranslate('Roll a die. On a 4+, I gain <ANCHORED>. On a 1-3, I gain 3 boosts.'),
        'output' =>  FT::ACTION(ROLL_DIE, [
          'effect' => ['1-3' => FT::GAIN(ME, BOOST, 3), '4+' => FT::GAIN(ME, ANCHORED)],
        ]),
      ],
      210 => ['description' => clienttranslate('Each player draws a card.'), 'output' =>  FT::ACTION(DRAW, [])],
      211 => ['description' => clienttranslate('I gain <ANCHORED>.'), 'output' => FT::GAIN(ME, ANCHORED)],
      212 => ['description' => clienttranslate('I gain <ANCHORED>.'), 'output' => FT::GAIN(ME, ANCHORED)],
      213 => ['description' => clienttranslate('I gain <ANCHORED>.'), 'output' => FT::GAIN(ME, ANCHORED)],
      214 => ['description' => clienttranslate('Characters  your opponents play can\'t cost less than {2}.'), 'noTrigger' => true, 'attributes' => ['opponentCharactersMinimumCost' => '2']],
      215 => [
        'description' => clienttranslate('Create a <BRASSBUG> Robot token in each of your Expeditions.'),
        'output' => FT::SEQ(
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'AX_Common_Brassbug',
            'targetLocation' => [STORM_RIGHT],
          ]),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'AX_Common_Brassbug',
            'targetLocation' => [STORM_LEFT],
          ])
        ),
      ],
      216 => [
        'description' => clienttranslate('Create a <BRASSBUG> Robot token in target Expedition. (BR)'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'AX_Common_Brassbug',
          'targetLocation' => STORMS,
        ]),
      ],
      217 => [
        'description' => clienttranslate('Each Character controlled by target player gains <FLEETING>.'),
        'output' => FT::ACTION(TARGET_PLAYER, ['opponentsOnly' => false, 'effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'fleetingAllCharacters'])])
      ],
      218 => [
        'description' => clienttranslate('Each player may <RESUPPLY_INF>.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'eachPlayerOptionalResupply'])
      ],
      219 => [
        'description' => clienttranslate('Each player puts the top card of their deck in their Mana zone (as an exhausted Mana Orb).'),
        'output' => FT::ACTION(DRAW, ['location' => MANA, 'tapped' => true])
      ],
      221 => ['description' => clienttranslate('I gain <ASLEEP>.'), 'output' => FT::GAIN(ME, ASLEEP)],
      222 => [
        'description' => clienttranslate('Sacrifice a Character in my Expedition.'),
        'output' => FT::ACTION(
          TARGET,
          [
            'targetPlayer' => ME,
            'targetType' => [CHARACTER, TOKEN],
            'targetLocation' => ['source'],
            'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice'])
          ]
        ),
      ],
      223 => [
        'description' => clienttranslate('Sacrifice one Character.'),
        'output' => FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [CHARACTER, TOKEN],
          'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
        ]),
      ],
      224 => [
        'description' => clienttranslate('Sacrifice two Characters.'),
        'output' => FT::ACTION(
          TARGET,
          [
            'targetPlayer' => ME,
            'targetType' => [CHARACTER, TOKEN],
            'n' => 2,
            'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice'])
          ]
        )
      ],
      225 => [
        'description' => clienttranslate('Target opponent discards a card from their hand.'),
        'output' => FT::ACTION(TARGET_PLAYER, ['effect' =>  FT::ACTION(
          TARGET,
          [
            'targetPlayer' => ME,
            'targetLocation' => [HAND],
            'targetType' => [CHARACTER, SPELL, PERMANENT],
            'effect' => FT::ACTION(DISCARD, []),
          ]
        )])
      ],
      226 => ['description' => clienttranslate('The {j}, {h} and {r} abilities of Characters facing me can\'t activate.'), 'noTrigger' => true, 'attributes' => ['dynamicBlockingPower' => 'block']],
      228 => [
        'description' => clienttranslate('You may put me in my owner\'s Mana zone (as an exhausted Mana Orb).'),
        'output' => FT::ACTION(
          DISCARD,
          ['cardId' => ME, 'destination' => MANA, 'tapped' => true, 'canPass' => true, 'force' => true]
        ),
      ],
      229 => [
        'description' => clienttranslate('You may put me in my owner\'s Mana zone (as an exhausted Mana Orb). If you don\'t, draw a card.'),
        'output' => FT::XOR(
          FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => MANA, 'force' => true, 'tapped' => true]),
          FT::ACTION(DRAW, ['players' => ME])
        )
      ],
      230 => ['description' => clienttranslate('Target opponent draws a card.'), 'output' =>  FT::ACTION(DRAW, ['players' => OPPONENT])],
      232 => [
        'description' => clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in my Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => ['source'],
        ]),
      ],
      233 => [
        'description' => clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in target Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
        ]),
      ],
      234 => [
        'description' => clienttranslate('The next Character you play this turn gains 1 boost.'),
        'output' =>  FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1Boost']),
      ],
      237 => ['description' => clienttranslate('<AFTER_YOU>.'),  'output' => FT::ACTION(AFTER_YOU, []),],
      238 => [
        'description' => clienttranslate('Target Character gains <ANCHORED>.'),
        'output' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, ANCHORED)]),
      ],
      241 => [
        'description' => clienttranslate('The next Character you play this turn gains 2 boosts.'),
        'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains2Boost']),
      ],
      242 => ['description' => clienttranslate('<RESUPPLY>.'), 'output' => FT::ACTION(RESUPPLY, []),],
      243 => ['description' => clienttranslate('I gain <FLEETING>.'),  'output' => FT::GAIN(ME, FLEETING)],
      244 => [
        'description' => clienttranslate('You may activate the {j} abilities of target Permanent you control.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [PERMANENT],
          'upTo' => true,
          'targetPlayer' => ME,
          'hasEffects' => ['Played'],
          'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
        ]),
      ],
      245 => ['description' => clienttranslate('Draw a card.'),  'output' => FT::ACTION(DRAW, ['players' => ME])],
      246 => ['description' => clienttranslate('I am <GIGANTIC>.'), 'attributes' => ['gigantic' => true]],
      248 => [
        'description' => clienttranslate('You may return a card from your Reserve to your hand.'),
        'output' =>  FT::ACTION(
          TARGET,
          [
            'targetLocation' => [RESERVE],
            'targetPlayer' => ME,
            'targetType' => [CHARACTER, TOKEN, PERMANENT, SPELL],
            'upTo' => true,
            'effect' => FT::RETURN_TO_HAND(),
          ]
        ),
      ],
      // Alizé
      301 => ['description' => clienttranslate('<DEFENDER> Characters don\'t prevent my Expedition from moving forward.'), 'noTrigger' => true, 'attributes' => ['ignoreDefender' => true]],
      386 => ['description' => clienttranslate('<DEFENDER> Characters don\'t prevent my Expedition from moving forward.'), 'noTrigger' => true, 'attributes' => ['ignoreDefender' => true]],
      264 => ['description' => clienttranslate('<EXHAUSTED_RESUPPLY>.'), 'output' => FT::ACTION(RESUPPLY, ['exhausted' => true])],
      404 => ['description' => clienttranslate('<RESUPPLY>, otherwise <EXHAUSTED_RESUPPLY>.'), 'output' => FT::ACTION(RESUPPLY, []), 'oppositeOutput' => FT::ACTION(RESUPPLY, ['exhausted' => true])],
      402 => [
        'description' => clienttranslate('<SABOTAGE>, otherwise you may exhaust target card in Reserve.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
        'oppositeOutput' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'upTo' => true,
          'targetLocation' => [RESERVE],
          'effect' => FT::ACTION(EXHAUST, [])
        ])
      ],
      266 => ['description' => clienttranslate('Any number of target Characters in {V} gain 2 boosts.'), 'output' => FT::ACTION(TARGET, ['expeditionAttributes' => [FOREST], 'n' => INFTY, 'upTo' => true, 'effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])]),],
      268 => ['description' => clienttranslate('Cards other than me cost {1} more to play from Reserve.'), 'attributes' => ['increaseReserveCost' => 1]],
      379 => [
        'description' => clienttranslate('Create a <BRASSBUG> Robot token in my Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'AX_Common_Brassbug',
          'targetLocation' => ['source'],
        ]),
      ],
      381 => [
        'description' => clienttranslate('Create a <BRASSBUG> Robot token in your Companion Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'AX_Common_Brassbug',
          'targetLocation' => [STORM_RIGHT],
        ]),
      ],
      382 => [
        'description' => clienttranslate('Create a <BRASSBUG> Robot token in your Hero Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'AX_Common_Brassbug',
          'targetLocation' => [STORM_LEFT],
        ]),
      ],
      380 => [
        'description' => clienttranslate('Create a <BRASSBUG> Robot token in your other Expedition (the one I\'m not in).'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'AX_Common_Brassbug',
          'targetLocation' => ['oppositeSource'],
        ]),
      ],
      270 => [
        'description' => clienttranslate('Create a <MANA_MOTH> Illusion token in each of your Expeditions.'),
        'output' => FT::SEQ(
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'YZ_Common_ManaMoth',
            'targetLocation' => [STORM_LEFT],
          ]),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'YZ_Common_ManaMoth',
            'targetLocation' => [STORM_RIGHT],
          ]),
        )
      ],
      413 => [
        'description' => clienttranslate('Create a <MANA_MOTH> Illusion token in each of your Expeditions.'),
        'output' => FT::SEQ(
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'YZ_Common_ManaMoth',
            'targetLocation' => [STORM_LEFT],
          ]),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'YZ_Common_ManaMoth',
            'targetLocation' => [STORM_RIGHT],
          ]),
        )
      ],
      271 => [
        'description' => clienttranslate('Create a <MANA_MOTH> Illusion token in my Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => ['source'],
        ]),
      ],
      414 => [
        'description' => clienttranslate('Create a <MANA_MOTH> Illusion token in my Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => ['source'],
        ]),
      ],
      272 => [
        'description' => clienttranslate('Create a <MANA_MOTH> Illusion token in target Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => STORMS,
        ]),
      ],
      415 => [
        'description' => clienttranslate('Create a <MANA_MOTH> Illusion token in target Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => STORMS,
        ]),
      ],
      273 => [
        'description' => clienttranslate('Create a <MANA_MOTH> Illusion token in your Companion Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => [STORM_RIGHT],
        ]),
      ],
      416 => [
        'description' => clienttranslate('Create a <MANA_MOTH> Illusion token in your Companion Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => [STORM_RIGHT],
        ]),
      ],
      274 => [
        'description' => clienttranslate('Create a <MANA_MOTH> Illusion token in your Hero Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => [STORM_LEFT],
        ]),
      ],
      417 => [
        'description' => clienttranslate('Create a <MANA_MOTH> Illusion token in your Hero Expedition.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => [STORM_LEFT],
        ]),
      ],
      275 => [
        'description' => clienttranslate('Create a <MANA_MOTH> Illusion token in your other Expedition (the one I\'m not in).'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => ['oppositeSource'],
        ]),
      ],
      418 => [
        'description' => clienttranslate('Create a <MANA_MOTH> Illusion token in your other Expedition (the one I\'m not in).'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => ['oppositeSource'],
        ]),
      ],
      406 => [
        'description' => clienttranslate('Create an <ORDIS_RECRUIT> Soldier token in each of your Expeditions, otherwise create one in my Expedition.'),
        'output' => FT::SEQ(
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => [STORM_RIGHT],
          ]),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => [STORM_LEFT],
          ])
        ),
        'oppositeOutput' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => ['source'],
        ])
      ],
      276 => ['description' => clienttranslate('Create one <ORDIS_RECRUIT> Soldier token in my Expedition per Bureaucrat you control.'), 'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'invokeOrdisRecruitBureaucrat'])],
      401 => [
        'description' => clienttranslate('Create two <BRASSBUG> Robot tokens in target Expedition, otherwise create only one.'),
        'output' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'n' => 2,
          'tokenType' => 'AX_Common_Brassbug',
          'targetLocation' => STORMS,
        ]),
        'oppositeOutput' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'AX_Common_Brassbug',
          'targetLocation' => STORMS,
        ])
      ],
      277 => [
        'description' => clienttranslate('Create two <MANA_MOTH> Illusion tokens in target Expedition.'),
        'output' =>  FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'n' => 2,
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => STORMS,
        ]),
      ],
      399 => ['description' => clienttranslate('Draw a card, otherwise <RESUPPLY>.'), 'output' => FT::ACTION(DRAW, ['players' => ME]), 'oppositeOutput' => FT::ACTION(RESUPPLY, [])],
      279 => ['description' => clienttranslate('Each Character in target Expedition gains 1 boost.'), 'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostAllCharactersInExpedition'])],
      280 => [
        'description' => clienttranslate('Each Character you control other than me gains 1 boost.'),
        'output' =>  [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'boostAllCharactersExceptSelf'],
        ],
      ],
      281 => [
        'description' => clienttranslate('Each player chooses a Character they control. It gains <ASLEEP>.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'eachPlayerAsleep'],
        ],
      ],
      377 => ['description' => clienttranslate('Each player exhausts a card in their Reserve.'), 'output' => ''],
      283 => ['description' => clienttranslate('Each player may put a card from their Hand in Reserve to draw a card.'), 'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'eachPlayerOptionalHandReserve'])],
      285 => ['description' => clienttranslate('Exchange target Card in your Reserve with a card from your Hand.'), 'output' => FT::ACTION(EXCHANGE, ['targetType' => [PERMANENT, SPELL, CHARACTER]]),],
      286 => ['description' => clienttranslate('Exchange target Character in your Reserve with a card from your Hand.'), 'output' => FT::ACTION(EXCHANGE, []),],
      287 => ['description' => clienttranslate('Exchange target Spell in your Reserve with a card from your Hand.'), 'output' => FT::ACTION(EXCHANGE, ['targetType' => [SPELL]]),],
      288 => ['description' => clienttranslate('Exhaust me.'), 'output' => FT::ACTION(EXHAUST, ['cardId' => ME])],
      290 => [
        'description' => clienttranslate('Exhaust up to two cards in Reserve.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'upTo' => true,
          'n' => 2,
          'targetLocation' => [RESERVE],
          'effect' => FT::ACTION(EXHAUST, [])
        ]),
      ],
      291 => ['description' => clienttranslate('Exhausted Characters in Reserve remain exhausted during Morning.'), 'attributes' => ['exhaustCharactersMorning' => true]],
      431 => ['description' => clienttranslate('I am <DEFENDER>.'), 'noTrigger' => true, 'attributes' => ['dynamicDefender' => 'fullDefender']],
      265 => ['description' => clienttranslate('I am <TOUGH_X>, where X is the number of exhausted cards in Reserve.'), 'noTrigger' => true, 'attributes' => ['dynamicTough' => 'exhaustedReserve']],
      427 => ['description' => clienttranslate('I can gain <FLEETING> even if I was already <FLEETING>.'), 'noTrigger' => true, 'attributes' => ['canAlwaysGainFleeting' => true]],
      292 => ['description' => clienttranslate('I gain 1 boost and <FLEETING>.'), 'output' => FT::SEQ(FT::GAIN(ME, BOOST), FT::GAIN(ME, FLEETING))],
      294 => ['description' => clienttranslate('I gain 1 boost per <FLEETING> Character you control.'), 'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXFleetingChar'])],
      390 => ['description' => clienttranslate('I gain 1 boost per <FLEETING> Character you control.'), 'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXFleetingChar'])],
      295 => ['description' => clienttranslate('I gain 1 boost per Expedition in {V}.'), 'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXForForest'])],
      296 => ['description' => clienttranslate('I gain 2 boosts and <FLEETING>.'), 'output' => FT::SEQ(FT::GAIN(ME, BOOST, 2), FT::GAIN(ME, FLEETING))],
      400 => ['description' => clienttranslate('I gain 2 boosts, otherwise I gain 1 boost.'), 'output' => FT::GAIN(ME, BOOST, 2), 'oppositeOutput' => FT::GAIN(ME, BOOST)],
      297 => ['description' => clienttranslate('If I would gain <ASLEEP>, I gain <ANCHORED> instead.'), 'noTrigger' => true, 'attributes' => ['dynamicGainReplace' => [ASLEEP => ANCHORED]]],
      298 => ['description' => clienttranslate('If I would gain <FLEETING>, I gain 1 boost instead.'), 'noTrigger' => true, 'attributes' => ['dynamicGainReplace' => [FLEETING => BOOST]]],
      421 => ['description' => clienttranslate('If I would gain <FLEETING>, I gain 1 boost instead.'), 'noTrigger' => true, 'attributes' => ['dynamicGainReplace' => [FLEETING => BOOST]]],
      422 => ['description' => clienttranslate('If the Expedition facing me is in {M}, it can only move forward due to {M}.'), 'noTrigger' => true, 'attributes' => ['opponentMountainOnly' => true]],
      299 => ['description' => clienttranslate('If the Expedition facing me is in {O}, it can only move forward due to {O}.'), 'noTrigger' => true, 'attributes' => ['opponentOceanOnly' => true]],
      300 => ['description' => clienttranslate('If the Expedition facing me is in {V}, it can only move forward due to {V}.'), 'noTrigger' => true, 'attributes' => ['opponentForestOnly' => true]],
      302 => ['description' => clienttranslate('My region and the region of the Expedition facing me are {V} and lose their other types.'), 'attributes' => ['updateExpeditions' => ['type' => 'sourceAll', 'regionsRemove' => [OCEAN, MOUNTAIN], 'regionsAdd' => [FOREST]],]],
      303 => ['description' => clienttranslate('My region is {V} in addition to its other types.'), 'attributes' => ['updateExpeditions' => ['type' => 'source', 'regionsAdd' => [FOREST]],]],
      395 => ['description' => clienttranslate('My region is {V} in addition to its other types.'), 'attributes' => ['updateExpeditions' => ['type' => 'source', 'regionsAdd' => [FOREST]],]],
      306 => ['description' => clienttranslate('Ready all cards in your Reserve.'), 'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'readyAllReserve'])],
      308 => [
        'description' => clienttranslate('Roll a die, then target a Character. On a 4+, it gains <ANCHORED>. On a 1-3, it gains <ASLEEP>.'),
        'output' => FT::SEQ(
          FT::GAIN(ME, FLEETING),
          FT::ACTION(ROLL_DIE, [
            'effect' => [
              '1-3' =>  FT::ACTION(TARGET, [
                'effect' => FT::GAIN(EFFECT, ASLEEP),
              ]),
              '4+' =>  FT::ACTION(TARGET, [
                'effect' => FT::GAIN(EFFECT, ANCHORED),
              ])
            ],
          ]),
        )
      ],
      420 => [
        'description' => clienttranslate('Sacrifice a Character in my Expedition and I gain 1 boost.'),
        'output' => FT::SEQ(
          FT::ACTION(TARGET, [
            'targetPlayer' => ME,
            'targetType' => [CHARACTER, TOKEN],
            'targetLocation' => ['source'],
            'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
          ]),
          FT::GAIN(ME, BOOST)
        )
      ],
      311 => ['description' => clienttranslate('Sacrifice me.'), 'output' => FT::ACTION(DISCARD, ['cardId' => ME, 'desc' => 'sacrifice'])],
      305 => ['description' => clienttranslate('Send me to Reserve.'), 'output' => FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => RESERVE])],
      424 => ['description' => clienttranslate('Send me to Reserve.'), 'output' => FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => RESERVE])],
      282 => [
        'description' => clienttranslate('Starting with you, each player may immediately play a card with Hand Cost {3} or less for free.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'playAll1Card'],
        ],
      ],
      318 => [
        'description' => clienttranslate('Target a Character, then roll a die. On a 4+, it gains <ANCHORED>. On a 1-3, it gains <ASLEEP>.'),
        'output' => FT::ACTION(TARGET, [
          'effect' => FT::ACTION(ROLL_DIE, [
            'effect' => [
              '1-3' => FT::GAIN(EFFECT, ASLEEP),
              '4+' => FT::GAIN(EFFECT, ANCHORED),
            ],
          ]),
        ]),
      ],
      319 => ['description' => clienttranslate('Target Character gains 1 boost and <FLEETING>.'), 'output' => FT::ACTION(TARGET, ['effect' => FT::SEQ(FT::GAIN(EFFECT, FLEETING), FT::GAIN(EFFECT, BOOST))])],
      320 => ['description' => clienttranslate('Target Character gains 2 boosts and <FLEETING>.'), 'output' => FT::ACTION(TARGET, ['effect' => FT::SEQ(FT::GAIN(EFFECT, FLEETING), FT::GAIN(EFFECT, BOOST, 2))])],
      323 => ['description' => clienttranslate('Target Character other than me gains 1 boost.'), 'output' => FT::ACTION(TARGET, ['excludeSelf' => true, 'effect' => FT::GAIN(EFFECT, BOOST)]),],
      429 => ['description' => clienttranslate('Target Character with Hand Cost {3} or less gains <ANCHORED>.'), 'output' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN(ME, ANCHORED)])],
      428 => ['description' => clienttranslate('Target Character with Hand Cost {3} or less gains <ANCHORED>.'), 'output' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN(ME, ANCHORED)])],
      324 => ['description' => clienttranslate('Target Character you control with Hand Cost {4} or less gains <ASLEEP>.'), 'output' => ''],
      325 => [
        'description' => clienttranslate('Target opponent may <EXHAUSTED_RESUPPLY_INF> twice.'),
        'output' => FT::ACTION(TARGET_PLAYER, ['opponentsOnly' => true, 'effect' => FT::SEQ_OPTIONAL(
          FT::ACTION(RESUPPLY, ['exhausted' => true], ['pId' => 'active']),
          FT::ACTION(RESUPPLY, ['exhausted' => true], ['pId' => 'active'])
        )])
      ],
      396 => [
        'description' => clienttranslate('Target opponent may <EXHAUSTED_RESUPPLY_INF> twice.'),
        'output' => FT::ACTION(TARGET_PLAYER, ['opponentsOnly' => true, 'effect' => FT::SEQ_OPTIONAL(
          FT::ACTION(RESUPPLY, ['exhausted' => true], ['pId' => 'active']),
          FT::ACTION(RESUPPLY, ['exhausted' => true], ['pId' => 'active'])
        )])
      ],
      326 => ['description' => clienttranslate('Target opponent may <EXHAUSTED_RESUPPLY_INF>.'), 'output' => FT::ACTION(TARGET_PLAYER, ['opponentsOnly' => true, 'effect' => FT::SEQ_OPTIONAL(FT::ACTION(RESUPPLY, ['exhausted' => true], ['pId' => 'active']))])],
      397 => ['description' => clienttranslate('Target opponent may <EXHAUSTED_RESUPPLY_INF>.'), 'output' => FT::ACTION(TARGET_PLAYER, ['opponentsOnly' => true, 'effect' => FT::SEQ_OPTIONAL(FT::ACTION(RESUPPLY, ['exhausted' => true], ['pId' => 'active']))])],
      327 => [
        'description' => clienttranslate('Target player sacrifices a Character.'),
        'output' =>  FT::ACTION(
          TARGET_PLAYER,
          [
            'opponentsOnly' => false,
            'effect' => FT::ACTION(TARGET, [
              'targetPlayer' => ME,
              'targetType' => [CHARACTER, TOKEN],
              'n' => 1,
              'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
            ])
          ]
        )
      ],
      407 => [
        'description' => clienttranslate('The next Bureaucrat you play this turn costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => BUREAUCRAT, 'reduction' => 1]],
        ],
      ],
      408 => [
        'description' => clienttranslate('The next card you play this turn costs {1} less.'),
        'output' =>  [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => ALL, 'reduction' => 1]],
        ],
      ],
      387 => [
        'description' => clienttranslate('The next Character you play this Afternoon costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => CHARACTER, 'reduction' => 1, 'permanent' => true]],
        ],
      ],
      412 => [
        'description' => clienttranslate('The next Character you play this turn costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => SPELL, 'reduction' => 1, 'permanent' => false]],
        ],
      ],
      328 => [
        'description' => clienttranslate('The next Permanent you play this Afternoon costs {3} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 3, 'permanent' => true]],
        ],
      ],
      329 => [
        'description' => clienttranslate('The next Permanent you play this Afternoon costs {4} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 4, 'permanent' => true]],
        ],
      ],
      409 => [
        'description' => clienttranslate('The next Permanent you play this turn costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 1, 'permanent' => false]],
        ],
      ],
      410 => [
        'description' => clienttranslate('The next Plant you play this turn costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => PLANT, 'reduction' => 1]],
        ],
      ],
      411 => [
        'description' => clienttranslate('The next Spell you play this turn costs {1} less.'),
        'output' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => SPELL, 'reduction' => 1]],
        ],
      ],
      330 => [
        'description' => clienttranslate('You may give target <FLEETING> Character 1 boost.'),
        'output' => FT::ACTION(
          TARGET,
          [
            'targetType' => [CHARACTER, TOKEN],
            'upTo' => true,
            'excludeSelf' => true,
            'statuses' => FLEETING,
            'effect' => FT::GAIN(EFFECT, BOOST)
          ]
        )
      ],
      331 => [
        'description' => clienttranslate('You may give target <FLEETING> Character 2 boosts.'),
        'output' => FT::ACTION(
          TARGET,
          [
            'targetType' => [CHARACTER, TOKEN],
            'upTo' => true,
            'excludeSelf' => true,
            'statuses' => FLEETING,
            'effect' => FT::GAIN(EFFECT, BOOST, 2)
          ]
        )
      ],
      321 => [
        'description' => clienttranslate('You may give 2 boosts to target Character in {V}.'),
        'output' => FT::ACTION(TARGET, ['expeditionAttributes' => [FOREST], 'upTo' => true,  'effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])]),
      ],
      388 => [
        'description' => clienttranslate('You may give 2 boosts to target Character in {V}.'),
        'output' => FT::ACTION(TARGET, ['expeditionAttributes' => [FOREST], 'upTo' => true,  'effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])]),
      ],
      332 => [
        'description' => clienttranslate('You may have target Character or Expedition Permanent switch Expedition.'),
        'output' => FT::XOR(
          FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'upTo' => true, 'effect' => FT::ACTION(MOVE_CARD, [])]),
          FT::ACTION(TARGET, ['targetType' => [PERMANENT], 'upTo' => true, 'subtype' => EXPEDITION, 'effect' => FT::ACTION(MOVE_CARD, [])]),
        ),
      ],
      393 => [
        'description' => clienttranslate('You may have target Character or Expedition Permanent switch Expedition.'),
        'output' => FT::XOR(
          FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'upTo' => true, 'effect' => FT::ACTION(MOVE_CARD, [])]),
          FT::ACTION(TARGET, ['targetType' => [PERMANENT], 'upTo' => true, 'subtype' => EXPEDITION, 'effect' => FT::ACTION(MOVE_CARD, [])]),
        ),
      ],
      333 => ['description' => clienttranslate('You may have target Character switch Expedition.'), 'output' => FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'upTo' => true, 'effect' => FT::ACTION(MOVE_CARD, [])])],
      394 => ['description' => clienttranslate('You may have target Character switch Expedition.'), 'output' => FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'upTo' => true, 'effect' => FT::ACTION(MOVE_CARD, [])])],
      335 => ['description' => clienttranslate('When a <BOOSTED> Character would leave my Expedition during the Afternoon, it loses its boosts instead.'), 'noTrigger' => true, 'attributes' => ['protectBoostedInExpedition' => true]],
      336 => ['description' => clienttranslate('When an <ANCHORED> Character would leave my Expedition during the Afternoon, it loses <ANCHORED> instead.'), 'noTrigger' => true, 'attributes' => ['protectAnchoredInExpedition' => true]],
      337 => [
        'description' => clienttranslate('You may exhaust target card in an opponent\'s Reserve, then roll a die. When you roll a 1-3 this way — That opponent targets a card in your Reserve. Exhaust it.'),
        'output' =>  FT::ACTION(ROLL_DIE, [
          'effect' => [
            '1-3' =>  FT::ACTION(
              TARGET,
              [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'targetLocation' => [RESERVE],
                'targetPlayer' => OPPONENT,
                'effect' => FT::ACTION(EXHAUST, [])
              ],
              ['pId' => 'nextPlayer'],
            )
          ],
        ]),
      ],
      289 => [
        'description' => clienttranslate('You may exhaust target card in an opponent\'s Reserve, then roll a die. When you roll a 1-3 this way — That opponent targets a card in your Reserve. Exhaust it.'),
        'output' => FT::ACTION(ROLL_DIE, [
          'effect' => [
            '1-3' =>  FT::ACTION(
              TARGET,
              [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'targetLocation' => [RESERVE],
                'targetPlayer' => OPPONENT,
                'effect' => FT::ACTION(EXHAUST, [])
              ],
              ['pId' => 'nextPlayer'],
            )
          ],
        ]),
      ],
      338 => [
        'description' => clienttranslate('You may exhaust target card in Reserve.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(EXHAUST, [])
        ]),
      ],
      340 => ['description' => clienttranslate('You may have me gain <ASLEEP>.'), 'output' => FT::SEQ_OPTIONAL(FT::GAIN(ME, ASLEEP))],
      341 => [
        'description' => clienttranslate('You may have target Character in the Expedition facing me gain <ASLEEP>.'),
        'output' =>  FT::ACTION(TARGET, [
          'targetPlayer' => OPPONENT,
          'targetLocation' => ['source'],
          'targetType' => [CHARACTER, TOKEN],
          'effect' => FT::GAIN(EFFECT, ASLEEP),
        ])
      ],
      342 => [
        'description' => clienttranslate('You may immediately play a Character for {3} less.'),
        'output' => FT::SEQ_OPTIONAL(
          [
            'action' => SPECIAL_EFFECT,
            'args' => ['effect' => 'costReduction', 'args' => ['type' => CHARACTER, 'reduction' => 3, 'permanent' => false]],
          ],
          FT::ACTION(CHOOSE_ASSIGNMENT, ['types' => [CHARACTER], 'actions' => ['play']])
        )
      ],
      343 => [
        'description' => clienttranslate('You may immediately play a Character for {3} less. It gains <ANCHORED>.'),
        'output' => FT::SEQ_OPTIONAL(
          [
            'action' => SPECIAL_EFFECT,
            'args' => ['effect' => 'costReduction', 'args' => ['type' => CHARACTER, 'reduction' => 3, 'permanent' => false]],
          ],
          FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterAnchored']),
          FT::ACTION(CHOOSE_ASSIGNMENT, ['types' => [CHARACTER], 'actions' => ['play']])
        )
      ],
      344 => [
        'description' => clienttranslate('You may immediately play a Character for {3} less. It gains 1 boost.'),
        'output' => FT::SEQ_OPTIONAL(
          [
            'action' => SPECIAL_EFFECT,
            'args' => ['effect' => 'costReduction', 'args' => ['type' => CHARACTER, 'reduction' => 3, 'permanent' => false]],
          ],
          FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1Boost']),
          FT::ACTION(CHOOSE_ASSIGNMENT, ['types' => [CHARACTER], 'actions' => ['play']])
        )
      ],
      345 => [
        'description' => clienttranslate('You may immediately play a Character for {3} less. It gains 2 boosts.'),
        'output' => FT::SEQ_OPTIONAL(
          [
            'action' => SPECIAL_EFFECT,
            'args' => ['effect' => 'costReduction', 'args' => ['type' => CHARACTER, 'reduction' => 3, 'permanent' => false]],
          ],
          FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains2Boost']),
          FT::ACTION(CHOOSE_ASSIGNMENT, ['types' => [CHARACTER], 'actions' => ['play']])
        )
      ],
      346 => ['description' => clienttranslate('You may play exhausted cards from your Reserve.'), 'noTrigger' => true, 'attributes' => ['playTappedCards' => ['type' => 'all']]],
      391 => ['description' => clienttranslate('You may play exhausted cards from your Reserve.'), 'noTrigger' => true, 'attributes' => ['playTappedCards' => ['type' => 'all']]],
      347 => ['description' => clienttranslate('You may play exhausted Characters from your Reserve.'), 'noTrigger' => true, 'attributes' => ['playTappedCards' => ['type' => CHARACTER]]],
      348 => [
        'description' => clienttranslate('You may ready an exhausted card in Reserve.'),
        'output' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'targetLocation' => [RESERVE],
          'isTapped' => true,
          'upTo' => true,
          'effect' => FT::ACTION(READY, []),
        ]),
      ],
      349 => ['description' => clienttranslate('You may return target Character or Permanent to its owner\'s hand.'), 'output' => FT::ACTION(TARGET, ['upTo' => true, 'targetType' => [CHARACTER, TOKEN, PERMANENT], 'effect' => FT::RETURN_TO_HAND()])],
      350 => ['description' => clienttranslate('You may send target Character in {V} to Reserve.'), 'output' => FT::ACTION(TARGET, ['expeditionAttributes' => [FOREST],  'upTo' => true, 'effect' => FT::DISCARD_TO_RESERVE()])],
      314 => [
        'description' => clienttranslate('You may send target Character to Reserve, then exhaust it.'),
        'output' => FT::ACTION(TARGET, [
          'effect' => FT::SEQ(FT::DISCARD_TO_RESERVE(), FT::ACTION(EXHAUST, []))
        ])
      ],
      351 => ['description' => clienttranslate('You may send target Character to Reserve. Unless it was in {V}, its controller draws a card.'), 'output' => 'TODO'],
      312 => ['description' => clienttranslate('You may send to Reserve any number of target Characters with total {M} of 4 or less.'), 'output' => FT::ACTION(TARGET, ['upTo' => true, 'n' => INFTY, 'totalMountain' => 4, 'effect' => FT::DISCARD_TO_RESERVE()])],
      313 => ['description' => clienttranslate('You may send to Reserve any number of target Characters with total {M} of 5 or less.'), 'output' => FT::ACTION(TARGET, ['upTo' => true, 'n' => INFTY, 'totalMountain' => 5, 'effect' => FT::DISCARD_TO_RESERVE()])],
      315 => ['description' => clienttranslate('You may send to Reserve target Character with no statistic over 3.'), 'output' =>  FT::ACTION(TARGET, ['upTo' => true, 'maxStatistic' => 3, 'effect' => FT::DISCARD_TO_RESERVE()])],

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
    if (isset($trinity['output'])) {
      self::computeOutput($trinity['output'], $calculated);
    }

    // throw new \feException(print_r($calculated));

    if (!isset($calculated['type'])) {
      var_dump($trinity);
      throw new \feException(print_r($properties));
    }

    $key = $calculated['type'];
    $node = [];
    if (isset($calculated['noTrigger']) && $calculated['noTrigger'] === true) {
      // DynamicAttributes wll be used
      // if it exists, condition must be added at the end of the dynamic attribute
      if (isset($calculated['triggerConditions'])) {
        foreach (($calculated['outputAttributes'] ?? []) as $keyAttribute => $attribute) {
          if (!isset($properties[$keyAttribute])) {
            if (is_string($attribute) || is_bool($attribute)) {
              $properties[$keyAttribute] = $attribute . ':' . implode(':', $calculated['triggerConditions']);
            }
          } else {
            if (!is_array($properties[$keyAttribute])) {
              $tmp = [$properties[$keyAttribute]];
            }
            if (is_string($attribute) || is_bool($attribute)) {
              $tmp[] = $attribute . ':' . implode(':', $calculated['triggerConditions']);
            }
            $properties[$keyAttribute] = $tmp;
          }
        }
      } else {
        // no condition on the trigger
        foreach (($calculated['outputAttributes'] ?? []) as $keyAttribute => $attribute) {
          if (!isset($properties[$keyAttribute])) {
            $properties[$keyAttribute] = $attribute;
          } else {
            if (!is_array($properties[$keyAttribute])) {
              $tmp = [$properties[$keyAttribute]];
            }
            if (is_string($attribute) || is_bool($attribute)) {
              $tmp[] = $attribute;
            }
            $properties[$keyAttribute] = $tmp;
          }
        }
      }
    } elseif ($key != 'effectPassive') {
      // no natural condition check, we need to insert CheckConditions
      if (isset($calculated['triggerConditions'])) {
        self::insertCheckCondition($calculated['triggerConditions'], $node, [$calculated['conditionDescription'] ?? null, $calculated['outputDescription'] ?? null]);
      }
      if (isset($calculated['conditionEffect'])) {
        self::addEffectToCondition($calculated['conditionEffect'], $node);
      }
    } else {
      if (isset($calculated['trigger'])) {
        if (!is_array($calculated['trigger'])) {
          $calculated['trigger'] = [$calculated['trigger']];
        }

        $template = [];
        if (isset($calculated['triggerConditions'])) {
          $template['conditions'] = $calculated['triggerConditions'];
        }

        if (isset($calculated['oppositeOutput'])) {
          // management of Otherwise effect
          // Need to add another check condition as the trigger condition must be valid, but the condition is with the opposite
          $template['output'] = FT::ACTION(
            CHECK_CONDITION,
            [
              'conditions' => $calculated['conditionConditions'],
              'effect' => $calculated['conditionEffect'] ?? 'OUTPUT',
              'oppositeEffect' => $calculated['oppositeOutput'],
              'description' => [$calculated['conditionDescription'] ?? null, $calculated['outputDescription'] ?? null]
            ]
          );
        } else {
          if (isset($calculated['conditionEffect'])) {
            $template['output'] = $calculated['conditionEffect'];
          } else {
            $template['output'] = 'OUTPUT';
          }
          // if (isset($calculated['oppositeOutput'])) {
          //   $template['oppositeOutput'] = $calculated['oppositeOutput'];
          // } else {
          //   $template['oppositeOutput'] = 'OPPOSITE';
          // }
        }
        if (isset($calculated['conditionN'])) {
          $template['n'] = $calculated['conditionN'];
        }

        // Management of AfterRest effects (must happen after cleanup but the cards have been cleanup)
        if (($calculated['afterRest'] ?? '') == true) {
          $newOutput = ['action' => SPECIAL_EFFECT, 'args' => ['effect' => 'afterRest', 'args' => $calculated['output']]];
          $calculated['output'] = $newOutput;
        }

        foreach ($calculated['trigger'] as $t => $trig) {
          // add conditions + effect + output
          $node[$trig] = $template;
        }
      }
    }
    // throw new \feException(print_r($node));
    // output
    if (isset($calculated['output'])) {
      self::addOutputToNode($calculated['output'], $node);
    }
    if (isset($calculated['oppositeOutput'])) {
      self::addOppositeToNode($calculated['oppositeOutput'], $node);
    }

    // Specific interaction
    foreach ($node as $tr => &$eff) {
      // specific case for "When an opponent draws one or more cards or does Resupply "
      if ($tr == 'Morning') {
        if ($eff['conditions'] == ['isOpponentDraw', 'realResupply']) {
          $eff['conditions'] = ['isMe'];
        }
      }
    }

    // needed for passive effects in reaction to a classical output (171 for example)
    if (isset($calculated['passiveEffect'])) {
      if (isset($calculated['output'])) {
        self::addOutputToNode($calculated['output'], $calculated['passiveEffect']);
      }


      if (isset($properties['effectPassive'])) {
        $properties['effectPassive'] = array_merge($properties['effectPassive'], $calculated['passiveEffect']);
      } else {
        $properties['effectPassive'] = $calculated['passiveEffect'];
      }
    }

    if ((!isset($calculated['noTrigger']) || $calculated['noTrigger'] === false) && isset($calculated['outputAttributes'])) {
      $properties = array_merge($properties, $calculated['outputAttributes']);
    }

    // edge cases:
    if (in_array($trinity['trigger'], [8, 231]) && $trinity['condition'] == 190 && $trinity['output'] == 44) {
      $properties['sacrificeAndNotFleetingGoToReserve'] = true;
      $node = [];
    } elseif ($trinity['trigger'] == 239) {
      // Edge case for When an opponent draws one or more
      // bug #140378
      $node['Morning']['conditions'] = ['isMe'];
      $node['Resupply']['conditions'][] = 'realResupply';
    }

    // dynamic attributes generate empty node
    if (!empty($node)) {
      if (isset($properties[$key])) {
        // parallel node for non passive effects
        if ($key != 'effectPassive') {
          // there is already an effect, check if there is an PAR node, to add the node
          if (($properties[$key]['type'] ?? '') == NODE_PARALLEL) {
            $properties[$key]['childs'][] = $node;
          } else {
            // we add the PAR node
            $properties[$key] = FT::PAR($properties[$key], $node);
          }
        } else {
          // PassiveEffects
          // we need to merge per trigger if needed
          foreach ($properties[$key] as $existingTrigger => &$existingNode) {
            // Nothing to merge as it doesn't exist
            if (!isset($node[$existingTrigger])) {
              continue;
            }
            // throw new \feException("titi");
            // we already have childs
            if (isset($existingNode['childs'])) {
              $existingNode['childs'][] = $node[$existingTrigger];
            } else {
              $existingNode = ['childs' => array_merge([$existingNode], [$node[$existingTrigger]])];
            }
            unset($node[$existingTrigger]);
          }
          if (!empty($node)) {
            $properties[$key] = array_merge($properties[$key], $node);
          }
        }
      } else {
        $properties[$key] = $node;
      }
    }

    if (isset($calculated['outputPassive'])) {
      // add the condition to the passive effect, if it exists
      if (isset($calculated['triggerConditions'])) {
        foreach ($calculated['outputPassive'] as $trigger => &$passive) {
          $conditions = [];
          if (isset($passive['condition'])) {
            $conditions[] = $passive['condition'];
            unset($passive['condition']);
          }
          $passive['conditions'] = array_merge($passive['conditions'] ?? [], $conditions, $calculated['triggerConditions']);
        }
      }
      $properties['effectPassive'] = array_merge($properties['effectPassive'] ?? [], $calculated['outputPassive']);
    }

    // Description
    $keyDesc = $key == 'effectSupport' ? 'supportDesc' : 'effectDesc';
    if (!empty($properties[$keyDesc])) {
      $properties[$keyDesc][] = '<BR>';
    }
    $properties[$keyDesc][] = $calculated['triggerDescription'] ?? '';
    $properties[$keyDesc][] = $calculated['conditionDescription'] ?? '';
    $properties[$keyDesc][] = $calculated['outputDescription'] ?? '';

    if ($key == 'effectSupport') {
      if ($calculated['triggerDescription'] == '{D}') {
        $properties['supportIcon'] = 'discard';
      }
    }

    // debug
    //$properties['calculated'] = $calculated;

    // throw new \feException(print_r($calculated));
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
      $calculated['triggerConditions'] = array_merge(($calculated['triggerConditions'] ?? []), is_array($trigger['condition']) ? $trigger['condition'] : [$trigger['condition']]);
    }
    if (isset($trigger['description'])) {
      $calculated['triggerDescription'] = $trigger['description'];
    }
    if (isset($trigger['afterRest'])) {
      $calculated['afterRest'] = true;
    } else {
      $calculated['afterRest'] = false;
    }
    if (isset($trigger['n'])) {
      $calculated['conditionN'] = $trigger['n'];
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
      if ($calculated['type'] != 'effectPassive') {
        $calculated['triggerConditions'] = array_merge(($calculated['triggerConditions'] ?? []), is_array($conditions['condition']) ? $conditions['condition'] : [$conditions['condition']]);
      } else {
        // changed due to otherwise effect
        $calculated['conditionConditions'] = array_merge(($calculated['conditionConditions'] ?? []), is_array($conditions['condition']) ? $conditions['condition'] : [$conditions['condition']]);
      }
    }

    if (isset($conditions['effect'])) {
      $calculated['conditionEffect'] = $conditions['effect'];
    }

    if (isset($conditions['passiveEffect'])) {
      $calculated['passiveEffect'] = $conditions['passiveEffect'];
    }
  }

  public static function computeOutput($effect, &$calculated)
  {
    $output = self::getOutput()[$effect] ?? null;

    if (is_null($output)) {
      throw new \BgaVisibleSystemException('Unique conditions not implemented.' . $effect);
    }
    if (isset($output['description'])) {
      $calculated['outputDescription'] = $output['description'];
    }

    if (isset($output['output'])) {
      $calculated['output'] = $output['output'];
    }
    if (isset($output['passive'])) {
      $calculated['outputPassive'] = $output['passive'];
    }
    if (isset($output['attributes'])) {
      $calculated['outputAttributes'] = $output['attributes'];
    }
    // For No trigger effects, 
    if (isset($output['noTrigger'])) {
      $calculated['noTrigger'] = true;
    }
    if (isset($output['oppositeOutput'])) {
      $calculated['oppositeOutput'] = $output['oppositeOutput'];
    }

    // manage unique power attributes (tough/gigantic/) awaiting info from GDs
  }

  public static function insertCheckCondition($conditions, &$node, $description)
  {
    if (empty($node)) {
      $node = FT::ACTION(CHECK_CONDITION, ['conditions' => $conditions, 'effect' => 'OUTPUT', 'oppositeEffect' => 'OPPOSITE', 'description' => $description]);
    } else {
      $nKey = Utils::search($node, function ($child) {
        return ($child['action'] ?? '') == CHECK_CONDITION;
      });
      $node[$nKey]['conditions'] = array_merge(is_array($node[$nKey]['conditions']) ?  $node[$nKey]['conditions'] : [$node[$nKey]['conditions']], $conditions);
    }
  }

  public static function addEffectToCondition($effect, &$node)
  {
    if (empty($node)) {
      $node = $effect;
    } else {
      $node = Utils::updateTree($node, 'OUTPUT', $effect);
    }
  }

  public static function addOppositeToNode($effect, &$node)
  {
    if (empty($node)) {
      $node = $effect;
    } else {
      $node = Utils::updateTree($node, 'OPPOSITE', $effect);
    }
  }


  // TODO: to replace with previous function 
  public static function addOutputToNode($effect, &$node)
  {
    if (empty($node)) {
      $node = $effect;
    } else {
      $node = Utils::updateTree($node, 'OUTPUT', $effect);
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
