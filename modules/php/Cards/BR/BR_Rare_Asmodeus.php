<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Asmodeus extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_20_R2',
      'asset' => 'ALT_CORE_B_LY_20_R',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Asmodeus',
      'typeline' => 'Character - Deity',
      'type' => CHARACTER,
      'flavorText' => 'Wanna play a game?',
      'artist' => 'Zero Wen',
      'subtypes' => [DEITY],
      'effectDesc' => '{J} Roll a die. On a 4+, I gain $<ANCHORED>. On a 1-3, I gain 3 boosts.',
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 6,
      'costReserve' => 6,
      'effectPlayed' => FT::ACTION(ROLL_DIE, [
        'effect' => ['1-3' => FT::GAIN(ME, BOOST, 3), '4+' => FT::GAIN(ME, ANCHORED)],
      ]),
    ];
  }
}
