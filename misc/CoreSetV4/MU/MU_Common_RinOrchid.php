<?php
namespace ALT\Cards\MU;

class MU_Common_RinOrchid extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_P_MU_03_C',
      'asset' => 'ALT_CORE_P_MU_03_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => 'Rin & Orchid',
      'typeline' => 'Muna Hero',
      'type' => HERO,
      'flavorText' => 'MISSING FLAVOR',
      'artist' => 'MISSING ARTIST',
    ];
  }
}
