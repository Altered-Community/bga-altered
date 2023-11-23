<?php

namespace ALT\Cards\OD;

class OD_Common_Charge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_23_C',
      'asset' => 'ALT_CORE_B_OR_23_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Charge!'),
      'type' => SPELL,
      'subtype' => SUPPORT,
      'effectDesc' => clienttranslate('$[FLEETING].  Your Characters gain 1 boost.  '),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
