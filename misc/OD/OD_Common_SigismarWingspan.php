<?php
namespace ALT\Cards\OD;

class OD_Common_SigismarWingspan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '128',
      'asset' => 'OR-02_Sigimar-Wingspan_RGB',
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate('Sigismar & Wingspan'),
      'type' => HERO,
      'subtype' => 'Ordis Hero',
      'typeline' => '',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('At Dawn � Create a [1/1/1 Ordis Recruit] Soldier token in your Hero Expedition.'),
    ];
  }
}
