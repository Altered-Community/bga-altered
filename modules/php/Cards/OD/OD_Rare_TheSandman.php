<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_TheSandman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_15_R2',
      'asset' => 'ALT_CORE_B_LY_15_R',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'The Sandman',
      'typeline' => 'Character - Artist',
      'type' => CHARACTER,
      'flavorText' =>
      '"Sand gives you a taste of what life is all about. Come morning, the castles you have built will be gone with the tide."',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [ARTIST],
      'effectDesc' =>
      '{H} Up to one target Character gains <ASLEEP>. #You may have it gain 2 boosts.# (During Dusk, ignore its statistics. During Rest, it doesn\'t go to Reserve and it loses Asleep.)',
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 2,
      'changedStats' => ['costReserve'],
      'effectHand' => FT::ACTION(TARGET, [
        'upTo' => true, 'effect' => FT::XOR(
          FT::GAIN(EFFECT, ASLEEP),
          FT::SEQ(
            FT::GAIN(EFFECT, ASLEEP),
            FT::GAIN(EFFECT, BOOST, 2)
          )
        )
      ]),
    ];
  }
}
