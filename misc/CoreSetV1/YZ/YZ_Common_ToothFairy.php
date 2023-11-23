<?php

namespace ALT\Cards\YZ;

class YZ_Common_ToothFairy extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_06_C',
      'asset' => 'ALT_CORE_B_YZ_06_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Tooth Fairy'),
      'type' => CHARACTER,
      'subtype' => FAIRY,
      'effectDesc' => clienttranslate('{M} $[SABOTAGE].  '),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
