<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_OuroborosTrickster extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_06_R2',
      'asset' => 'ALT_CORE_B_LY_06_R',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ouroboros Trickster'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('Like the Bravos, Lyras are drawn to freedom and the distant horizon.'),
      'artist' => 'Zero Wen',
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate('{J} Roll a die. On a 4+, I gain 2 boosts. On a 1-3, I gain 1 boost.'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 1,
      'effectPlayed' => FT::ACTION(ROLL_DIE, [
        'effect' => ['1-3' => FT::GAIN(ME, BOOST, 1), '4+' => FT::GAIN(ME, BOOST, 2)],
      ]),
    ];
  }
}
