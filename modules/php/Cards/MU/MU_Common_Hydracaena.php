<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Hydracaena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_22_C',
      'asset' => 'ALT_CORE_B_MU_22_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => 'Hydracaena',
      'typeline' => 'Character - Dragon Plant',
      'type' => CHARACTER,
      'flavorText' =>
      'When they reach adult size, it\'s clear that the Dracaenas have really thrived on all that rest and relaxation.',
      'artist' => 'Ba Vo',
      'subtypes' => [DRAGON, PLANT],
      'effectDesc' => '$<ETERNAL>.  {J} I gain 4 boosts.  At Noon — I gain 4 boosts.',
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 7,
      'costReserve' => 7,
      'eternal' => true,
      'effectPlayed' => FT::GAIN($this, BOOST, 4),
      'effectPassive' => [
        'Noon' => [
          'condition' => 'myTurn',
          'output' => FT::GAIN($this, BOOST, 4)
        ]
      ]
    ];
  }
}
