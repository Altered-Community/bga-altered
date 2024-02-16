<?php
namespace ALT\Cards\OD;

class OD_Common_WaruMack extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_P_OR_02_C',
      'asset' => 'ALT_CORE_P_OR_02_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'Waru & Mack',
      'typeline' => 'Ordis Hero',
      'type' => HERO,
      'flavorText' => 'MISSING FLAVOR',
      'artist' => 'MISSING ARTIST',
    ];
  }
}
