<?php
namespace ALT\Cards\OD;

class OD_Common_SigismarWingspan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '128',
      'asset' => 'OD-02-Sigimar-Wingspan',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('Sigismar & Wingspan'),
      'typeline' => clienttranslate('Ordis Hero'),
      'rarity' => RARITY_COMMON,
      'type' => HERO,
      'subtype' => '',

      'effectDesc' => clienttranslate('At Dawn - Create a [1/1/1 Ordis Recruit] Soldier token in your Hero Expedition.'),
    ];
  }
}
