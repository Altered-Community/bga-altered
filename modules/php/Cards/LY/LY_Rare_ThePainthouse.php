<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_ThePainthouse extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_81_R1',
      'asset'  => 'ALT_CYCLONE_B_LY_81_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("The Painthouse"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('The paints of the Tisdhera still perfume the heights of the Wayfarer.'),
      'artist' => "Tristan Bideau",
      'extension' => 'SO',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{J} <RESUPPLY>, then #<RESUPPLY_LOW> again.#  At Noon — If three or more single-terrain regions are visible, you may give #2 boosts# to target Character in Reserve.'),
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(FT::ACTION(RESUPPLY, []), FT::ACTION(RESUPPLY, [])),
      'effectPassive' => [
        'Noon' => [
          'listeningConditions' => ['isMe'],
          'condition' => 'countMonoVisibleRegions:3',
          'effect' => FT::ACTION(TARGET, ['targetLocation' => [RESERVE], 'upTo' => true, 'effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])]),
        ]
      ]
    ];
  }
}
