<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisCarrier extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_30_C',
      'asset' => 'ALT_CORE_B_OR_30_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ordis Carrier'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('At Noon — Create a [Ordis Recruit 1/1/1] Soldier token in your Companion Expedition.'),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
