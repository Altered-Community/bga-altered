<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_MapmakersBoon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_80_C',
      'asset'  => 'ALT_CYCLONE_B_LY_80_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Mapmaker's Boon"),
      'typeline' => clienttranslate("Spell - Boon"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Each of us paints their own reality.'),
      'artist' => "Anh Tung",
      'extension' => 'SO',
      'subtypes'  => [BOON],
      'effectDesc' => clienttranslate('If three or more single-terrain regions are visible, target Character gains 4 boosts. Otherwise, it gains 2 boosts.'),
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::XOR(
        FT::ACTION(CHECK_CONDITION, ['condition' => 'countMonoVisibleRegions:3', 'effect' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, BOOST, 4)]), 'description' => clienttranslate('4 <BOOST>')]),
        FT::ACTION(CHECK_CONDITION, ['condition' => 'countMonoVisibleRegions:2:LTE', 'effect' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, BOOST, 2)]), 'description' => clienttranslate('2 <BOOST>')]),
      )
    ];
  }
}
