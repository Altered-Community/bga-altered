<?php

namespace ALT\Cards\LY;

class LY_Common_LyraThespian extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_05_C',
      'asset' => 'ALT_CORE_B_LY_05_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Lyra Thespian'),
      'type' => CHARACTER,
      'subtype' => ARTIST,
      'effectDesc' => clienttranslate('{J} If you have at least 3 base statistics 0 among your Characters, I gain 1 boost.  '),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
