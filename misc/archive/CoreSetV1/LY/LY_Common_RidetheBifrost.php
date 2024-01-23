<?php

namespace ALT\Cards\LY;

class LY_Common_RidetheBifrost extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_28_C',
      'asset' => 'ALT_CORE_B_LY_28_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ride the Bifrost'),
      'type' => SPELL,
      'subtype' => MANEUVER,
      'effectDesc' => clienttranslate('$[FLEETING].  Swap all of your Characters between your Expeditions.'),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
