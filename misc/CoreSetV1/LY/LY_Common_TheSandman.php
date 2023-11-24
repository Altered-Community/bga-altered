<?php

namespace ALT\Cards\LY;

class LY_Common_TheSandman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_15_C',
      'asset' => 'ALT_CORE_B_LY_15_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('The Sandman'),
      'type' => CHARACTER,
      'subtype' => MERCHANT,
      'effectDesc' => clienttranslate('{M} Another target Character becomes $[ASLEEP].'),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
