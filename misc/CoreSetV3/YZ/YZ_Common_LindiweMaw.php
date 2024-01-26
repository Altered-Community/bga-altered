<?php
namespace ALT\Cards\YZ;

class YZ_Common_LindiweMaw extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_02_C',
      'asset' => 'ALT_CORE_B_YZ_02_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => 'Lindiwe & Maw',
      'typeline' => 'Yzmir Hero',
      'type' => HERO,
      'flavorText' => 'To master magic, one must be willing to sacrifice.',
      'artist' => 'Edward Cheekokseang',
      'effectDesc' =>
        '{T} : Create a [MAW] Companion token in your Companion Expedition with \"When you sacrifice a Character — I gain 2 boosts\". This action costs {1} more if you are not the first player.',
    ];
  }
}
