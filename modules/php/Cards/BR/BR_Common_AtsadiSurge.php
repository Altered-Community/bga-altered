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
        'I begin the game with five Heroism counters.  When you play a Character with Hand Cost greater than or equal to my number of Heroism counters — Draw a card and I gain a Heroism counter.'
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
      'typeline' => clienttranslate('Hero'),
    ];
  }
}
