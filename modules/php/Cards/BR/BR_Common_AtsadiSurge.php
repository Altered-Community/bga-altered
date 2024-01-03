<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_AtsadiSurge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_02_C',
      'asset' => 'ALT_CORE_B_BR_02_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Atsadi & Surge'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'I begin the game with 5 Heroism Counters.  When you play a Character with hand cost equal to or higher than my number of Heroism Counters, draw a card and I gain a Heroism Counter.'
      ),

      'reserveSlots' => 2,
      'landmarkSlots' => 2,
      'extraDatas' => ['counter' => 5, 'counterName' => clienttranslate('Heroism counter')],

      'effectPassive' => [
        'ChooseAssignment' => [
          'condition' => 'costHigherThanCounter',
          'output' => FT::SEQ(
            FT::ACTION(DRAW, ['players' => ME]),
            FT::ACTION(SPECIAL_EFFECT, [
              'effect' => 'incCounter',
              'args' => ['counter' => 1, 'counterName' => clienttranslate('Heroism counter')],
            ])
          ),
        ],
      ],
    ];
  }
}
