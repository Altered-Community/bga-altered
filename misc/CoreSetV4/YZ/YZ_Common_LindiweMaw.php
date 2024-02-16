<?php
namespace ALT\Cards\YZ;

class YZ_Common_LindiweMaw extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_P_YZ_02_C',
      'asset' => 'ALT_CORE_P_YZ_02_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => 'Lindiwe & Maw',
      'typeline' => 'Yzmir Hero',
      'type' => HERO,
      'flavorText' => 'MISSING FLAVOR',
      'artist' => 'MISSING ARTIST',
    ];
  }
}
