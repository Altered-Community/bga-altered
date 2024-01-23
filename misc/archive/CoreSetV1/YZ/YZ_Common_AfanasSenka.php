<?php
namespace ALT\Cards\YZ;

class YZ_Common_AfanasSenka extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_03_C',
      'asset' => 'ALT_CORE_B_YZ_03_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Afanas & Senka'),
      'type' => HERO,
      'effectDesc' => clienttranslate('Whenever you play a Spell — One of your Characters gains 1 boost.'),
    ];
  }
}
