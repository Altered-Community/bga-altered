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
      'effectDesc' => clienttranslate(
        '{T} : [After You]. This action costs {1} more if you are not the first player. (End your turn as if you had played a card. You may still play cards later this Day.)'
      ),
    ];
  }
}
