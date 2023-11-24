<?php

namespace ALT\Cards\YZ;

class YZ_Common_Baku extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_10_C',
      'asset' => 'ALT_CORE_B_YZ_10_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Baku'),
      'type' => CHARACTER,
      'subtype' => DEMON,
      'effectDesc' => clienttranslate('{M} Target opponent discards a card from their hand.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
