<?php

namespace ALT\Cards\BR;

class BR_Common_PhysicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_26_C',
      'asset' => 'ALT_CORE_B_BR_26_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Physical Training'),
      'type' => SPELL,
      'subtype' => SUPPORT,
      'effectDesc' => clienttranslate('Target Character gains 3 boosts.'),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
