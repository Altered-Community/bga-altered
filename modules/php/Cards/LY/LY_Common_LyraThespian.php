<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_LyraThespian extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_05_C',
      'asset' => 'ALT_CORE_B_LY_05_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Lyra Thespian'),
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'effectDesc' => clienttranslate(
        '{J} If you have three or more base statistics of 0 among Characters you control, I gain 1 boost$<BB>.'
      ),
      'typeline' => clienttranslate('Character - Artist'),
      'flavorText' => clienttranslate('"All the world’s a stage."'),
      'artist' => 'Rémi Jacquot',

      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boost3Stat0']),
    ];
  }
}
