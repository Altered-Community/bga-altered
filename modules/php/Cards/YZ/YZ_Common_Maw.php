<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

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
      'token' => true,
      'flavorText' => 'Always hungry for new ideas...',
      'artist' => 'Edward Cheekokseang',
      'subtypes' => [COMPANION],
      'effectDesc' => 'When you sacrifice a Character — I gain 2 boosts.',
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'effectPassive' => [
        'Discard' => [
          'condition' => 'isCharacterSacrifice',
          'output' => FT::GAIN($this, BOOST, 2)
        ]
      ]
    ];
  }
}
