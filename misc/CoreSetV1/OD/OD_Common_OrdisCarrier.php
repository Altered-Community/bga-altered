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
      'type' => PERMANENT,
      'subtype' => LANDMARK,
      'effectDesc' => clienttranslate('At Dawn — Create a [ORDIS_RECRUIT] Soldier token in your Companion Expedition.  '),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
