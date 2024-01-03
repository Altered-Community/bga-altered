<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_BasiraKaizaimon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_03_C',
      'asset' => 'ALT_CORE_B_BR_03_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Basira & Kaizaimon'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'Whenever one of your Characters is boosted — You may exhaust me ({T}) to give any target Character 1 boost.'
      ),

      'reserveSlots' => 2,
      'landmarkSlots' => 2,

      'effectPassive' => [
        'Gain' => [
          'condition' => 'isCharacterBoosted',
          'output' => FT::SEQ_OPTIONAL(
            FT::ACTION(TAP, []),
            FT::ACTION(TARGET, [
              'effect' => FT::GAIN(EFFECT, BOOST),
            ])
          ),
        ],
      ],
    ];
  }
}
