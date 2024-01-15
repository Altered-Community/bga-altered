<?php

namespace ALT\Cards\BR;

class BR_Rare_TheSpindleMunaBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_30_R2',
      'asset' => 'ALT_CORE_B_MU_30_R2',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Spindle, Muna Bastion'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('Characters you control have $[TOUGH_2].'),
      'costHand' => 3,
      'costReserve' => 3,
      'dynamicTough' => 'universalCharacter2',

    ];
  }
}
