<?php

namespace ALT\Cards\LY;

class LY_Common_LyraSkald extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_08_C',
      'asset' => 'ALT_CORE_B_LY_08_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Lyra Skald'),
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'typeline' => clienttranslate('Character - Artist'),
    ];
  }
}
