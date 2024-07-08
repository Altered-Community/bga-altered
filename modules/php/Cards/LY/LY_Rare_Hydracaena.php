<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Hydracaena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_22_R2',
      'asset' => 'ALT_CORE_B_MU_22_R',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Hydracaena'),
      'typeline' => clienttranslate('Character - Dragon Plant'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate(
        'When they reach adult size, it\'s clear that the Dracaenas have really thrived on all that rest and relaxation.'
      ),
      'artist' => 'Ba Vo',
      'subtypes' => [DRAGON, PLANT],
      'effectDesc' => clienttranslate('$<ETERNAL>.  {J} I gain 4 boosts.  At Noon — I gain 4 boosts.'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 7,
      'costReserve' => 7,
      'eternal' => true,
      'effectPlayed' => FT::GAIN($this, BOOST, 4),
      'effectPassive' => [
        'Noon' => [
          'condition' => 'isMe',
          'output' => FT::GAIN($this, BOOST, 4),
        ],
      ],
    ];
  }
}
