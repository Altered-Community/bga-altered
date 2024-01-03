<?php
namespace ALT\Cards\OD;

class OD_Rare_OrdisCarrier extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_30_R1',
      'asset' => 'ALT_CORE_B_OR_30_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ordis Carrier'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('At Noon — Create an [Ordis Recruit 1/1/1] Soldier token in each of your Expeditions.'),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
