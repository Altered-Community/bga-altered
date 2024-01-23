<?php

namespace ALT\Cards\OD;

class OD_Common_OrdisGatekeeper extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_13_C',
      'asset' => 'ALT_CORE_B_OR_13_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ordis Gatekeeper'),
      'type' => CHARACTER,
      'subtype' => SOLDIER,
      'effectDesc' => clienttranslate('{J} Create a [ORDIS_RECRUIT] Soldier token in your other Expedition.'),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
