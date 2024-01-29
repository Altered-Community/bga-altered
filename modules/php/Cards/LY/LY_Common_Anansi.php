<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_Anansi extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_13_C',
      'asset' => 'ALT_CORE_B_LY_13_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => 'Anansi',
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'effectDesc' => '{J} I gain 1 boost$<BB> for each card in your Reserve.',
      'typeline' => 'Character - Artist',
      'flavorText' =>
        'In the end, he had accumulated pretty well all the wisdom that was available. He put it in a gourd and made a stopper for it.',
      'artist' => 'Taras Susak',

      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXReserve']),
    ];
  }
}
