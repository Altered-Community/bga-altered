<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_TreystRossum extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_02_C',
      'asset' => 'ALT_CORE_B_AX_02_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Treyst & Rossum',
      'typeline' => 'Axiom Hero',
      'type' => HERO,
      'flavorText' => 'An energy system is a piece of subtle machinery to be optimized for better output.',
      'artist' => 'Taras Susak',
      'effectDesc' =>
      'When a card leaves your Reserve during the Afternoon, if I have less than five Scrap counters — I gain a Scrap counter.  If I have five or more Scrap counters, I gain \"{T} : Draw a card, then put a card from your hand in Reserve.\"',

      'reserveSlots' => 2,
      'landmarkSlots' => 2,

      'effectPassive' => [
        'ChooseAssignment' => [
          'condition' => 'isFromReserveAndLess5Counters',
          'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'incCounter', 'args' => ['counter' => 1, 'counterName' => clienttranslate('Scrap counter')]])
        ],
        'Discard' => [
          'condition' => 'isDiscardedFromReserveAndLess5Counters',
          'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'incCounter', 'args' => ['counter' => 1, 'counterName' => clienttranslate('Scrap counter')]])
        ]
      ],
      'effectTap' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'has5CounterOnCard',
        'effect' => FT::SEQ(
          FT::ACTION(DRAW, ['players' => ME]),
          FT::ACTION(
            TARGET,
            [
              'targetType' => [CHARACTER, SPELL, PERMANENT],
              'targetPlayer' => ME,
              'targetLocation' => [HAND],
              'effect' => FT::DISCARD_TO_RESERVE(),
            ],
          )
        )
      ]),
    ];
  }
}
