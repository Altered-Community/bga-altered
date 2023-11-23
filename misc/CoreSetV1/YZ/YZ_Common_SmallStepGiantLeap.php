<?php

namespace ALT\Cards\YZ;

class YZ_Common_SmallStepGiantLeap extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_25_C',
      'asset' => 'ALT_CORE_B_YZ_25_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Small Step, Giant Leap'),
      'type' => SPELL,
      'subtype' => MANEUVER,
      'effectDesc' => clienttranslate('$[FLEETING].  Target Expedition moves forward.  '),
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}
