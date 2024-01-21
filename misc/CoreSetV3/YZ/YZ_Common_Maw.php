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
      'name' => 'Maw',
      'typeline' => 'Token - Companion',
      'type' => TOKEN,
      'flavorText' => 'Always hungry for new ideas...',
      'artist' => 'MISSING ARTIST',
      'subtypes' => [COMPANION],
      'effectDesc' => 'When you sacrifice a Character — I gain 2 boosts.',
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
    ];
  }
}
