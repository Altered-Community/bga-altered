<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_LyraMapmaker extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_69_C',
      'asset'  => 'ALT_CYCLONE_B_LY_69_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Lyra Mapmaker"),
      'typeline' => clienttranslate("Character - Artist"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('When the map covers the whole landscape, which one is more real?'),
      'artist' => "Matteo Spirito",
      'extension' => 'SO',
      'subtypes'  => [ARTIST],
      'effectDesc' => clienttranslate('{J} If three or more single-terrain regions are visible, I gain 1 boost.'),
      'forest' => 2,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'countMonoVisibleRegions:3', 'effect' => FT::GAIN(ME, BOOST)])
    ];
  }
}
