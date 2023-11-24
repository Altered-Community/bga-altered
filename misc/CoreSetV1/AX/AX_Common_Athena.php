<?php

namespace ALT\Cards\AX;

class AX_Common_Athena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_18_C',
      'asset' => 'ALT_CORE_B_AX_18_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Athena'),
      'type' => CHARACTER,
      'subtype' => DIVINITY,
      'effectDesc' => clienttranslate('{S} If you have at least 2 Landmarks, I lose [FLEETING_CHAR].'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
