<?php

namespace ALT\Cards\OD;

class OD_Common_OpentheGates extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_26_C',
      'asset' => 'ALT_CORE_B_OR_26_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Open the Gates'),
      'type' => SPELL,
      'subtype' => SUPPORT,
      'effectDesc' => clienttranslate('Create two [ORDIS_RECRUIT] Soldier tokens in both of your Expeditions.'),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
