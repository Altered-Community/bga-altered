<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_LyraClothDancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_14_C',
      'asset' => 'ALT_CORE_B_LY_14_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Lyra Cloth-Dancer'),
      'type' => CHARACTER,
      'subtype' => [ARTIST],
      'effectDesc' => clienttranslate('{M} Another target Character becomes $[FLEETING].'),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(TARGET, ['excludeSelf' => true, 'effect' => FT::GAIN(EFFECT, FLEETING)]),
    ];
  }
}
