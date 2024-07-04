<?php

namespace ALT\Helpers;

use ALT\Core\Globals;
use ALT\Managers\Players;

// Allow to use a short flow description syntax
abstract class FlowConvertor
{
  public function getTriggers()
  {
    return  [
      1 => ['description' => clienttranslate('{R}'), 'trigger' => '', 'type' => 'effectReserve'],
      2 => ['description' => clienttranslate('When an opponent draws one or more cards or does [RESUPPLY_T] —'), 'trigger' => ['Draw', 'Resupply', 'Morning'], 'condition' => 'notMeandDrawNotMana'],
      4 => ['description' => clienttranslate('When one of your Expeditions moves forward due to {V} —'), 'trigger' => 'AfterDusk', 'condition' => 'movesStormsWithForest'], // to check if bug with Rin
      5 => ['description' => clienttranslate('When a Robot joins your Expeditions —'), 'trigger' => ['ChooseAssignment', 'InvokeToken'], 'condition' => 'isRobotPlayed'],
      7 => ['description' => clienttranslate('When I go to Reserve from your hand —'), 'trigger' => 'Discard', 'condition' => 'isDiscardedFromHandToReserve'],
      8 => ['description' => clienttranslate('When I\'m sacrificed —'), 'trigger' => 'Discard', 'condition' => 'isSacrificed'],
      10 => ['description' => clienttranslate('When you play a Permanent with Hand Cost {3} or more —'), 'trigger' => 'ChooseAssignment', 'condition' => 'isPermanentAndCost3'],
      11 => ['description' => clienttranslate('When I go to Reserve from the Expedition zone —'), 'trigger' => 'LeaveExpedition', 'condition' => 'notFleeting'],
      12 => ['description' => clienttranslate('When I leave the Expedition zone —'), 'trigger' => 'LeaveExpedition'],
      13 => ['description' => clienttranslate('When a Character you control gains 1 or more boosts —'), 'trigger' => 'Gain', 'condition' => 'isCharacterBoostedAndUntap'], // condition to check
      14 => ['description' => clienttranslate('When my Expedition fails to move forward during Dusk — After Rest:'), 'trigger' => 'AfterDusk', 'condition' => 'myExpeditionHasNotMoved'],
      15 => ['description' => clienttranslate('When you play another Character with a base statistic of 0 —'), 'trigger' => 'ChooseAssignment', 'condition' => 'isWithZeroStatAndNotMe'],
      16 => ['description' => clienttranslate('When you play a Permanent —'), 'trigger' => 'ChooseAssignment', 'condition' => 'isPermanent'],
      17 => ['description' => clienttranslate('At Dusk —'), 'trigger' => 'BeforeDusk'],
      19 => ['description' => clienttranslate('When another non-token Character joins your Expeditions —'), 'trigger' => 'ChooseAssignment', 'condition' => 'isOtherCharacterNonTokenPlayed'],
      20 => ['description' => clienttranslate('At Noon —'), 'trigger' => 'Noon', 'condition' => 'myTurn'],
      21 => ['description' => clienttranslate('When another Character joins your Expeditions —'), 'trigger' => ['ChooseAssignment', 'InvokeToken'], 'condition' => 'isOtherCharacterPlayed'],
      22 => ['description' => clienttranslate('{H}'), 'trigger' => '', 'type' => 'effectHand'],
      // 23 => ['description' => clienttranslate('[]]'), 'trigger' => ''],
      24 => ['description' => clienttranslate('{J}'), 'trigger' => '', 'type' => 'effectPlayed'],
      25 => ['description' => clienttranslate('When you create a token —'), 'trigger' => 'InvokeToken', 'condition' => 'myTurn'],
      26 => ['description' => clienttranslate('When you roll one or more dice —'), 'trigger' => 'RollDie', 'condition' => 'myTurn'],
      27 => ['description' => clienttranslate('When you play a Spell —'), 'trigger' => 'ChooseAssignment', 'condition' => 'isSpellPlayed'],
      28 => ['description' => clienttranslate('When a card leaves your Reserve during the Afternoon —'), 'trigger' => ['ChooseAssignment', 'Discard'], 'condition' => 'isFromReserveAfternoon'],
      192 => ['description' => clienttranslate('{D}'), 'trigger' => '', 'type' => 'effectSupport'],
      231 => ['description' => clienttranslate('When I\'m sacrificed —'),  'trigger' => 'Discard', 'condition' => 'isSacrificed'],
      236 => ['description' => clienttranslate('When my Expedition fails to move forward during Dusk — After Rest:'), 'trigger' => 'AfterDusk', 'condition' => 'myExpeditionHasNotMoved'],
      239 => ['description' => clienttranslate('When an opponent draws one or more cards or does [RESUPPLY_T] —'), 'trigger' => ['Draw', 'Resupply', 'Morning'], 'condition' => 'notMeandDrawNotMana'],
      240 => ['description' => clienttranslate('When I gain 1 or more boosts —'), 'trigger' => 'Gain', 'condition' => 'has1Boost'],
    ];
  }

  public function getConditions()
  {
    return [
      166 => ['description' => clienttranslate('If you control two or more Plants other than me:'), 'condition' => 'control2OtherPlants'],
      167 => ['description' => clienttranslate('If you have three or more base statistics of 0 among Characters you control:'), 'condition' => 'has3WithZeroStat'],
      168 => ['description' => clienttranslate('If I have 3 or more boosts:'), 'condition' => 'has3Boost'],
      169 => ['description' => clienttranslate('If you control two or more [BOOSTED_CHA_P] Characters:'), 'condition' => 'control2BoostedCharacters'],
      170 => [
        'description' => clienttranslate('You may discard one of your Mana Orbs. If you do:'),
        'effect' => FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetLocation' => [MANA],
          'targetType' => [CHARACTER, TOKEN, SPELL, PERMANENT],
          'effect' => FT::ACTION(DISCARD, []),
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
            'effect' => FT::DISCARD_TO_RESERVE(),
          ],
          ['optional' => true]
        ),
        'passiveEffect' => [']Discard' => ['condition' => 'isSourceAndDiscardPermanent']] // to check
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
        'passiveEffect' => ['Discard' => ['condition' => 'isSourceAndDiscardSpell']] // to check
      ],
      173 => ['description' => clienttranslate('If you control four or more Characters:'), 'condition' => 'control4Characters'],
      175 => [
        'description' => clienttranslate('You may sacrifice a Permanent. If you do:'),
        'effect' =>  FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [PERMANENT],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
        ])
      ],
      176 => ['description' => clienttranslate('If you control two or more Landmarks:'), 'condition' => 'control2Landmarks'],
      177 => [
        'description' => clienttranslate('Roll a die. On a 4+:'),
        'effect' => FT::ACTION(ROLL_DIE, [
          'effect' => ['4+' => 'TODO'],
        ])
      ],
      178 => [
        'description' => clienttranslate('You may sacrifice a Character. If you do:'),
        'effect' =>  FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [TOKEN, CHARACTER],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
        ])
      ],
      179 => ['description' => clienttranslate('If you control three or more Characters:'), 'condition' => 'control3Characters'],
      180 => [
        'description' => clienttranslate('You may sacrifice a Character or Permanent. If you do:'),
        'effect' =>  FT::ACTION(TARGET, [
          'targetPlayer' => ME,
          'targetType' => [TOKEN, CHARACTER, PERMANENT],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
        ])
      ],
      181 => ['description' => clienttranslate('If I have 1 or more boosts:'), 'condition' => 'has1Boost'],
      182 => ['description' => clienttranslate('You may put a card from your hand in Reserve. If you do:'), 'condition' => ''],
      183 => ['description' => clienttranslate('If I have 2 or more boosts:'), 'condition' => ''],
      186 => ['description' => clienttranslate('You may pay {1}. If you do:'), 'condition' => ''],
      187 => ['description' => clienttranslate('You may discard a card from your Reserve. If you do:'), 'condition' => ''],
      188 => ['description' => clienttranslate('If you control a token:'), 'condition' => ''],
      189 => ['description' => clienttranslate('If you control one or more Landmarks:'), 'condition' => ''],
      190 => ['description' => clienttranslate('If I\'m not [FLEETING]:'), 'condition' => ''],
      191 => ['description' => clienttranslate('[]]'), 'condition' => ''],
      198 => ['description' => clienttranslate('If you have less than eight Mana Orbs:'), 'condition' => ''],
      201 => ['description' => clienttranslate('Unless you control two or more Plants other than me:'), 'condition' => ''],
      202 => ['description' => clienttranslate('Unless you control two or more Bureaucrats other than me:'), 'condition' => ''],
      247 => ['description' => clienttranslate('You may sacrifice me. If you do:'), 'condition' => ''],

    ];
  }

  public static function constructEffect($trinity, &$properties)
  {
    $calculated = [];
    if (isset($trinity['trigger'])) {
      self::computeTrigger($trinity['trigger'], $calculated);
    }
    if (isset($trinity['condition'])) {
      self::computeTrigger($trinity['condition'], $calculated);
    }
    if (isset($trinity['output'])) {
      self::computeTrigger($trinity['output'], $calculated);
    }

    // use calculated to generate the effect in properties
    // if effect dans condition => noeud SEQ
    // Trigger condition => vrai check condition
    // TODO/ passiveEffect

  }

  public  static function computeTrigger($effect, &$calculated)
  {
    if (!isset($trigger[$effect])) {
      throw new \BgaVisibleSystemException('Unique trigger not implemented.' . $effect);
    }
    $trigger = self::getTriggers()[$effect];
    $calculated['type'] = $trigger['type'] ?? 'passive';
    if (isset($trigger['trigger']) && $trigger['trigger'] != '') {
      $calculated['trigger'] = $trigger['trigger'];
    }
    if (isset($trigger['condition'])) {
      $calculated['triggerConditions'] = array_merge(($calculated['triggerConditions'] ?? []), [$trigger['condition']]);
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
