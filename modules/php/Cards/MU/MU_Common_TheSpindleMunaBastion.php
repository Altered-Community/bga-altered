<?php

namespace ALT\Cards\MU;

class MU_Common_TheSpindleMunaBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_30_C',
      'asset' => 'ALT_CORE_B_MU_30_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('The Spindle, Muna Bastion'),
      'type' => PERMANENT,
      'subtype' => LANDMARK,
      'effectDesc' => clienttranslate('Characters in your Expeditions have $[TOUGH_2].'),
      'costHand' => 3,
      'costReserve' => 3,

      'dynamicTough' => 'universalCharacter2',
    ];
  }
}
