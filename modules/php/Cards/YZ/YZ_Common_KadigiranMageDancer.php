<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_KadigiranMageDancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_07_C',
      'asset' => 'ALT_CORE_B_YZ_07_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kadigiran Mage-Dancer'),
      'typeline' => clienttranslate('Character - Soldier Mage'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('"Don\'t just wait for magic to happen. Go out and make your own!"'),
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [SOLDIER, MAGE],
      'effectDesc' => clienttranslate('When you play a Spell — I gain 1 boost$<BB>.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 1,
      'effectPassive' => [
        'ChooseAssignment' => [
          'condition' => 'isCardPlayed:spell',
          'output' => FT::GAIN(ME, BOOST),
        ],
      ],
    ];
  }
}
