<?php

namespace ALT\Cards\MU;

class MU_Common_Nurture extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_27_C',
      'asset' => 'ALT_CORE_B_MU_27_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Nurture'),
      'type' => SPELL,
      'subtype' => SUPPORT,
      'effectDesc' => clienttranslate('Up to two target Characters gain 1 boost.  '),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
