<?php
namespace ALT\Cards\OD;

class OD_Common_GrandEndeavor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_29_C',
      'asset' => 'ALT_CORE_B_OR_29_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Grand Endeavor'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('At Noon — Target Expedition moves forward.'),
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}
