<?php

namespace ALT\Cards\AX;

class AX_Common_MechanicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_22_C',
      'asset' => 'ALT_CORE_B_AX_22_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Mechanical Training'),
      'type' => SPELL,
      'subtype' => SUPPORT,
      'effectDesc' => clienttranslate('You may activate the {J} effect of one of your Permanents.'),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
