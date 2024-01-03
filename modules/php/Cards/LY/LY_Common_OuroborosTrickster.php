<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_OuroborosTrickster extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_06_C',
      'asset' => 'ALT_CORE_B_LY_06_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ouroboros Trickster'),
      'type' => CHARACTER,
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate('{J} Roll a die. On a 4 or higher, I gain 2 boosts. Otherwise, I gain 1 boost$[BB].'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 1,
      'effectPlayed' => FT::ACTION(ROLL_DIE, [
        'effect' => ['1-3' => FT::GAIN(ME, BOOST, 1), '4+' => FT::GAIN(ME, BOOST, 2)],
      ]),
      'typeline' => clienttranslate('Character - Citizen'),
    ];
  }
}
