<?php

namespace ALT\Cards\LY;

class LY_Common_Anansi extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_13_C',
      'asset' => 'ALT_CORE_B_LY_13_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Anansi'),
      'type' => CHARACTER,
      'subtype' => ARTIST,
      'effectDesc' => clienttranslate('{J} I gain 1 boost for each card in your Reserve.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
