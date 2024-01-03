<?php
namespace ALT\Cards\YZ;

class YZ_Rare_OrdisCarrier extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_30_R2',
      'asset' => 'ALT_CORE_B_OR_30_R2',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ordis Carrier'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('At Noon — Create an [ORDIS_RECRUIT] Soldier token in your Companion Expedition.'),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
