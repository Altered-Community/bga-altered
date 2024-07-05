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
      5 => ['description' => clienttranslate('When a Robot joins your Expeditions —'), 'trigger' => ['ChooseAssignment', 'InvokeToken'], 'condition' => 'isCardPlayed:robot'],
      7 => ['description' => clienttranslate('When I go to Reserve from your hand —'), 'trigger' => 'Discard', 'condition' => 'isDiscardedFromHandToReserve'],
      8 => ['description' => clienttranslate('When I\'m sacrificed —'), 'trigger' => 'Discard', 'condition' => 'isSacrificed'],
      10 => ['description' => clienttranslate('When you play a Permanent with Hand Cost {3} or more —'), 'trigger' => 'ChooseAssignment', 'condition' => 'isCardPlayed:permanent:3'],
      11 => ['description' => clienttranslate('When I go to Reserve from the Expedition zone —'), 'trigger' => 'LeaveExpedition', 'condition' => 'notFleeting'],
      12 => ['description' => clienttranslate('When I leave the Expedition zone —'), 'trigger' => 'LeaveExpedition'],
      13 => ['description' => clienttranslate('When a Character you control gains 1 or more boosts —'), 'trigger' => 'Gain', 'condition' => 'isCharacterBoostedAndUntap'], // condition to check
      14 => ['description' => clienttranslate('When my Expedition fails to move forward during Dusk — After Rest:'), 'trigger' => 'AfterDusk', 'condition' => 'myExpeditionHasNotMoved'],
      15 => ['description' => clienttranslate('When you play another Character with a base statistic of 0 —'), 'trigger' => 'ChooseAssignment', 'conditions' => ['isCardPlayed:::true', 'isCardPlayedWithZeroStat']],
      16 => ['description' => clienttranslate('When you play a Permanent —'), 'trigger' => 'ChooseAssignment', 'condition' => 'isCardPlayed:permanent'],
      17 => ['description' => clienttranslate('At Dusk —'), 'trigger' => 'BeforeDusk'],
      19 => ['description' => clienttranslate('When another non-token Character joins your Expeditions —'), 'trigger' => 'ChooseAssignment', 'condition' => 'isCardPlayed:characterOnly:::true'],
      20 => ['description' => clienttranslate('At Noon —'), 'trigger' => 'Noon', 'condition' => 'myTurn'],
      21 => ['description' => clienttranslate('When another Character joins your Expeditions —'), 'trigger' => ['ChooseAssignment', 'InvokeToken'], 'condition' => 'isCardPlayed:character:::true'],
      22 => ['description' => clienttranslate('{H}'), 'trigger' => '', 'type' => 'effectHand'],
      23 => ['description' => clienttranslate('[]]')],
      24 => ['description' => clienttranslate('{J}'), 'trigger' => '', 'type' => 'effectPlayed'],
      25 => ['description' => clienttranslate('When you create a token —'), 'trigger' => 'InvokeToken', 'condition' => 'myTurn'],
      26 => ['description' => clienttranslate('When you roll one or more dice —'), 'trigger' => 'RollDie', 'condition' => 'myTurn'],
      27 => ['description' => clienttranslate('When you play a Spell —'), 'trigger' => 'ChooseAssignment', 'condition' => 'isCardPlayed:spell'],
      28 => ['description' => clienttranslate('When a card leaves your Reserve during the Afternoon —'), 'trigger' => ['ChooseAssignment', 'Discard'], 'condition' => 'isFromReserveAfternoon'],
      192 => ['description' => clienttranslate('{D}'), 'trigger' => '', 'type' => 'effectSupport'],
      231 => ['description' => clienttranslate('When I\'m sacrificed —'),  'trigger' => 'Discard', 'condition' => 'isSacrificed'],
      236 => ['description' => clienttranslate('When my Expedition fails to move forward during Dusk — After Rest:'), 'trigger' => 'AfterDusk', 'condition' => 'myExpeditionHasNotMoved'],
      239 => ['description' => clienttranslate('When an opponent draws one or more cards or does [RESUPPLY_T] —'), 'trigger' => ['Draw', 'Resupply', 'Morning'], 'condition' => 'notMeandDrawNotMana'],
      240 => ['description' => clienttranslate('When I gain 1 or more boosts —'), 'trigger' => 'Gain', 'condition' => 'hasBoost'],
    ];
  }

  public function getConditions()
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
            'effect' => FT::SEQ(FT::DISCARD_TO_RESERVE(), 'OUTPUT')
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
        'passiveEffect' => ['Discard' => ['condition' => 'isSourceAndDiscardSpell', 'effect' => 'OUTPUT']] // to check
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
            'effect' => FT::SEQ(FT::SEQ(FT::ACTION(DISCARD, []), 'TODO'), 'OUTPUT')
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
      }
    }
    $properties[$key] = $node;

    $properties[$key == 'effectSupport' ? 'supportDesc' : 'effectDesc'] = [$calculated['triggerDescription'] ?? '', $calculated['conditionDescription'] ?? ''];
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
      $calculated['triggerConditions'] = array_merge(($calculated['triggerConditions'] ?? []), [$trigger['condition']]);
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
      $calculated['triggerConditions'] = array_merge(($calculated['triggerConditions'] ?? []), [$conditions['condition']]);
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
      $node[$nKey]['conditions'] = array_merge(is_array($node[$nKey]['conditions']) ?  $node[$nKey]['conditions'] : [$node[$nKey]['conditions']], $conditions);
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
