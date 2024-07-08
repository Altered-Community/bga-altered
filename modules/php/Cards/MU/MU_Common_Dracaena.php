<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Dracaena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_15_C',
      'asset' => 'ALT_CORE_B_MU_15_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Dracaena'),
      'typeline' => clienttranslate('Character - Dragon Plant'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate(
        'They\'re sometimes seen dozing close to a pond, soaking in the water and the sunlight... '
      ),
      'artist' => 'HuoMiao Studio',
      'subtypes' => [DRAGON, PLANT],
      'effectDesc' => clienttranslate('{J} I gain $<ANCHORED>.  At Noon — I gain 1 boost.'),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::GAIN($this, ANCHORED),
      'effectPassive' => [
        'Noon' => [
          'condition' => 'isMe',
          'output' => FT::GAIN($this, BOOST),
        ],
      ],
    ];
  }
}
