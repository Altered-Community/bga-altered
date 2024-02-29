<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Dracaena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_15_R2',
      'asset' => 'ALT_CORE_B_MU_15_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Dracaena',
      'typeline' => 'Character - Dragon Plant',
      'type' => CHARACTER,
      'flavorText' => 'They\'re sometimes seen dozing close to a pond, soaking in the water and the sunlight... ',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [DRAGON, PLANT],
      'effectDesc' => '{J} I gain $<ANCHORED>.  At Noon — I gain 1 boost.',
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::GAIN($this, ANCHORED),
      'effectPassive' => [
        'Noon' => [
          'condition' => 'myTurn',
          'output' => FT::GAIN($this, BOOST)
        ]
      ]
    ];
  }
}
