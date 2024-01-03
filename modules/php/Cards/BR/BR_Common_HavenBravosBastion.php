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
      'name' => clienttranslate('Haven, Bravos Bastion'),
      'type' => PERMANENT,
      'subtype' => [LANDMARK],
      'effectDesc' => clienttranslate('Your Characters have : "{S} I gain 1 boost."'),
      'costHand' => 2,
      'costReserve' => 2,

      'effectPassive' => [
        'ChooseAssignment' => [
          'condition' => 'isCharacterFromReserve',
          'output' => FT::GAIN(EFFECT, BOOST),
        ],
      ],
    ];
  }
}
