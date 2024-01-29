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
      'name' => 'Basira & Kaizaimon',
      'type' => HERO,
      'typeline' => 'Bravos Hero',
      'effectDesc' =>
        'When a Character you control gains 1 or more boosts — You may exhaust me ({T}) to have target Character gain 1 boost$<BB>.',
      'flavorText' => 'Only the worthy shall achieve true transcendence under my guidance.',
      'artist' => 'Nestor Papatriantafyllou',

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
