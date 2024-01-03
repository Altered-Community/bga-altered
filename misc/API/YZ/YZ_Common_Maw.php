<?php
namespace ALT\Cards\YZ;

class YZ_Common_Maw extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_31_C',
      'asset' => 'ALT_CORE_B_YZ_31_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Maw'),
      'typeline' => clienttranslate('Token - Companion'),
      'type' => TOKEN,
      'subtypes' => [COMPANION],
      'effectDesc' => clienttranslate(
        'When you sacrifice a Character — I gain 2 boosts. (If I leave the Expedition Zone, remove me from the game.)'
      ),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
    ];
  }
}
