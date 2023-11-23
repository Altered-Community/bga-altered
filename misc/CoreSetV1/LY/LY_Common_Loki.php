<?php

namespace ALT\Cards\LY;

class LY_Common_Loki extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_21_C',
      'asset' => 'ALT_CORE_B_LY_21_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Loki'),
      'type' => CHARACTER,
      'subtype' => DIVINITY,
      'effectDesc' => clienttranslate('{M} Each player discards their hand and draws 3 cards.  '),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}
