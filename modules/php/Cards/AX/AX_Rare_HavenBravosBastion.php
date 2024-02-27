<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;


class AX_Rare_HavenBravosBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_30_R2',
      'asset' => 'ALT_CORE_B_BR_30_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Haven, Bravos Bastion',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => 'Haven isn\'t where legends are born... it\'s where they live forever.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [LANDMARK],
      'effectDesc' => '#{J} $<RESUPPLY>.#  Your Characters have: \" {R} I gain 1 boost.\"',
      'costHand' => 2,
      'costReserve' => 2,
      'effectPassive' => [
        'ChooseAssignment' => [
          'condition' => 'isCharacterFromReserve',
          'output' => FT::GAIN(EFFECT, BOOST),
        ],
      ],
      'effectPlayed' => FT::ACTION(RESUPPLY, [])
    ];
  }
}
