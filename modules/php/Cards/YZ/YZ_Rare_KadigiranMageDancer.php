<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_KadigiranMageDancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_07_R',
      'asset' => 'ALT_CORE_B_YZ_07_R',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Kadigiran Mage-Dancer',
      'typeline' => 'Character - Soldier Mage',
      'type' => CHARACTER,
      'flavorText' => '"Don\'t just wait for magic to happen. Go out and make your own!"',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [SOLDIER, MAGE],
      'effectDesc' => 'When you play a Spell — I gain 1 boost.  #At Dusk, if I have 3 or more boosts — Draw a card.#',
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 1,
      'effectPassive' => [
        'ChooseAssignment' => [
          'condition' => 'isSpellPlayed',
          'output' => FT::GAIN($this, BOOST)
        ],
        'BeforeDusk' => [
          'condition' => 'has3Boost',
          'output' => FT::ACTION(DRAW, ['players' => ME]),
        ],
      ]
    ];
  }
}
