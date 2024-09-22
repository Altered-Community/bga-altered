<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_TheMonolithOrdisBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_28_C',
      'asset' => 'ALT_CORE_B_OR_28_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('The Monolith, Ordis Bastion'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('When a Character joins your Expeditions — It gains 1 boost$<BB>.'),
      'flavorText' => clienttranslate('A beacon of knowledge and order, a lighthouse towering high above the world.'),
      'artist' => 'Jean-Baptiste Andrier',

      'costHand' => 5,
      'costReserve' => 5,
      'effectPassive' => [
        'ChooseAssignment' => [
          'condition' => 'isCardAdded:character',
          'output' => FT::GAIN(EFFECT, BOOST),
        ],
        'InvokeToken' => [
          'condition' => 'isCardAdded:character',
          'output' => FT::GAIN(EFFECT, BOOST),
        ],
      ],
    ];
  }
}
