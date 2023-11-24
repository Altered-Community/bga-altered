<?php

namespace ALT\Cards\AX;

class AX_Common_KelonCylinder extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_26_C',
      'asset' => 'ALT_CORE_B_AX_26_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kelon Cylinder'),
      'type' => PERMANENT,
      'subtype' => LANDMARK,
      'effectDesc' => clienttranslate(
        '{T} : I gain two Kelon Counters.  {T}, Remove a Kelon Counter from me: The next Character you play gains 1 boost.'
      ),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
