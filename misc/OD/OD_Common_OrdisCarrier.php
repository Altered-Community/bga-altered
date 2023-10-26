<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisCarrier extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '153',
      'asset' => 'OR-44_Mesektet_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate('Ordis Carrier'),
      'type' => PERMANENT,
      'subtype' => '',
      'typeline' => '',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('At Dawn�� Create a [1/1/1 Ordis Recruit] Soldier token in your Companion Expedition.'),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
