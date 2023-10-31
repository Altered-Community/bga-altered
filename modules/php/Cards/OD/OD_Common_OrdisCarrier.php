<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisCarrier extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '153',
      'asset' => 'OD-30-Mesektet-C',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('Ordis Carrier'),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => PERMANENT,
      'subtype' => '',

      'effectDesc' => clienttranslate('At Dawn - Create a [1/1/1 Ordis Recruit] Soldier token in your Companion Expedition.'),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
