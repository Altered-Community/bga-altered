<?php

namespace ALT\Cards\MU;

class MU_Common_Parvati extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_18_C',
      'asset' => 'ALT_CORE_B_MU_18_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Parvati'),
      'type' => CHARACTER,
      'subtype' => DRUID,
      'effectDesc' => clienttranslate('{M} Target Character becomes $[ANCHORED].  '),
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
