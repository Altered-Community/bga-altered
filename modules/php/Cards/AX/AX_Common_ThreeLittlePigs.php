<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_ThreeLittlePigs extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_12_C',
      'asset' => 'ALT_CORE_B_AX_12_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('The Three Little Pigs'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER],
      'effectDesc' => clienttranslate('{J} If you have at least 2 cards in your Landmarks, I gain 1 boost.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'control2Landmarks',
        'effect' => FT::GAIN(ME, BOOST, 1),
      ]),
    ];
  }
}
