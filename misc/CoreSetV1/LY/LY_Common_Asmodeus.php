<?php

namespace ALT\Cards\LY;

class LY_Common_Asmodeus extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_20_C',
      'asset' => 'ALT_CORE_B_LY_20_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Asmodeus'),
      'type' => CHARACTER,
      'subtype' => DEMON,
      'effectDesc' => clienttranslate(
        '{J} Roll a die. If the result is 4 or more, I gain $[ANCHORED]. Otherwise, I gain 3 boosts.  '
      ),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}
