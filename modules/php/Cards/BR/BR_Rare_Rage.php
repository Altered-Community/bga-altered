<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Rage extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_80_R1',
      'asset'  => 'ALT_CYCLONE_B_BR_80_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Rage"),
      'typeline' => clienttranslate("Spell - Boon Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"If its fury does not wane, it will soon have a taste of my own!" - Sol'),
      'artist' => "Justice Wong",
      'extension' => 'SO',
      'subtypes'  => [BOON, DISRUPTION],
      'effectDesc' => clienttranslate('#<FLEETING>.#  #Target Character# gains 2 boosts and <FLEETING>.'),
      'costHand' => 1,
      'costReserve' => 1,
      'changedStats' => ['costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'effect' => FT::SEQ(
            FT::GAIN(EFFECT, FLEETING),
            FT::GAIN(EFFECT, BOOST, 2)
          )
        ])
      )
    ];
  }
}
