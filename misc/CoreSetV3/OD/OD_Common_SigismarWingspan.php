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
      'typeline' => clienttranslate('Ordis Hero'),
      'type' => HERO,
      'flavorText' => clienttranslate('Follow me, friends! If we stand together, nothing can stop us! '),
      'artist' => 'Edward Cheekokseang',
      'effectDesc' => clienttranslate('At Noon — Create an [ORDIS_RECRUIT] Soldier token in your Hero Expedition.'),
    ];
  }
}
