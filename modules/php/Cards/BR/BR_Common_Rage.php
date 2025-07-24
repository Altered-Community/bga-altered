<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_Rage extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_80_C',
      'asset'  => 'ALT_CYCLONE_B_BR_80_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Rage"),
      'typeline' => clienttranslate("Spell - Boon Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"If its fury does not wane, it will soon have a taste of my own!" - Sol'),
      'artist' => "Justice Wong",
      'extension' => 'SO',
      'subtypes'  => [BOON, DISRUPTION],
      'effectDesc' => clienttranslate('Target non-Fleeting Character gains 2 boosts and <FLEETING>. (If it would go to Reserve, it goes to discard instead.)'),
      'costHand' => 1,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(TARGET, [
        'excludedStatuses' => [FLEETING],
        'effect' => FT::SEQ(
          FT::GAIN(EFFECT, FLEETING),
          FT::GAIN(EFFECT, BOOST, 2)
        )
      ])

    ];
  }
}
