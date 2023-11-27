<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_ALTAsmodeus extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_20_R1',
      'asset' => 'ALT_CORE_B_LY_20_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('ALT Asmodeus'),
      'type' => CHARACTER,
      'subtype' => [DEMON],
      'effectDesc' => clienttranslate(
        '{J} Roll a die. If the result is 4 or more, I gain $[ANCHORED]. Otherwise, I gain 3 boosts.'
      ),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['forest', 'mountain', 'ocean', 'costHand', 'costReserve'],
      'effectPlayed' => FT::ACTION(ROLL_DIE, [
        'effect' => ['1-3' => FT::GAIN(ME, BOOST, 3), '4+' => FT::GAIN(ME, ANCHORED)],
      ]),
    ];
  }
}
