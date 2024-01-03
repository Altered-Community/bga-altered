<?php
namespace ALT\Cards\YZ;

class YZ_Common_AkeshaTaru extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_01_C',
      'asset' => 'ALT_CORE_B_YZ_01_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Akesha & Taru'),
      'typeline' => clienttranslate('Hero'),
      'type' => HERO,
      'effectDesc' => clienttranslate('{T} : $[AFTER_YOU]. You can only activate this if you are the first player.'),
    ];
  }
}
