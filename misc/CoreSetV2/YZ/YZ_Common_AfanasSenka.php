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
      'typeline' => clienttranslate('Yzmir Hero'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'When you play a Spell — Target Character you control gains 1 boost$[BB]. (Do this after the spell resolves.)'
      ),
    ];
  }
}
