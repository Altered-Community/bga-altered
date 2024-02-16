<?php
namespace ALT\Cards\LY;

class LY_Common_NevenkaBlotch extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_P_LY_01_C',
      'asset' => 'ALT_CORE_P_LY_01_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Nevenka & Blotch'),
      'typeline' => clienttranslate('Lyra Hero'),
      'type' => HERO,
      'flavorText' => clienttranslate('MISSING FLAVOR'),
      'artist' => 'MISSING ARTIST',
      'effectDesc' => clienttranslate('The first Character you play each Afternoon gains 1 boost$<BB>.'),
    ];
  }
}
