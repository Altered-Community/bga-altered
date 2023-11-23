<?php

namespace ALT\Cards\YZ;

class YZ_Common_SpyCraft extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_22_C',
      'asset' => 'ALT_CORE_B_YZ_22_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Spy Craft'),
      'type' => SPELL,
      'subtype' => DISRUPTION,
      'effectDesc' => clienttranslate('$[FLEETING].  $[SABOTAGE], $[RESUPPLY].  '),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
