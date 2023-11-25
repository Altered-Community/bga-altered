<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_OuroborosTrickster extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_10_C',
      'asset' => 'ALT_CORE_B_LY_10_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ouroboros Trickster'),
      'type' => CHARACTER,
      'subtype' => [ARTIST],
      'effectDesc' => clienttranslate('{J} Roll a die. If the result is 4 or more, I gain 2 boosts. Otherwise, I gain 1 boost.'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(ROLL_DIE, [
        'effect' => ['1-3' => FT::GAIN(ME, BOOST, 1), '4+' => FT::GAIN(ME, BOOST, 2)],
      ]),
    ];
  }
}
