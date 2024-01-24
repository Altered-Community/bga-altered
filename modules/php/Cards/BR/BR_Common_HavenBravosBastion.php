<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_HavenBravosBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_30_C',
      'asset' => 'ALT_CORE_B_BR_30_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => 'Haven, Bravos Bastion',
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => 'Your Characters have: \"{R} I gain 1 boost$[BB].\"',
      'costHand' => 2,
      'costReserve' => 2,

      'effectPassive' => [
        'ChooseAssignment' => [
          'condition' => 'isCharacterFromReserve',
          'output' => FT::GAIN(EFFECT, BOOST),
        ],
      ],
      'typeline' => 'Permanent - Landmark',
      'flavorText' => "Haven isn't where legends are born... it's where they live forever.",
      'artist' => 'HuoMiao Studio',
    ];
  }
}
