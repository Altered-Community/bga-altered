<?php
namespace ALT\Cards\OD;

class OD_Common_SigismarWingspan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_01_C',
      'asset' => 'ALT_CORE_B_OR_01_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Sigismar & Wingspan'),
      'type' => HERO,
      'effectDesc' => clienttranslate('At Dawn — Create a [ORDIS_RECRUIT] Soldier token in your Hero Expedition.  '),
    ];
  }
}
