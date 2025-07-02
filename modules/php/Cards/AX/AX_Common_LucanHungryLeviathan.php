<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_LucanHungryLeviathan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_74_C',
      'asset'  => 'ALT_CYCLONE_B_AX_74_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Lucan, Hungry Leviathan"),
      'typeline' => clienttranslate("Character - Leviathan"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('It bursts out of the clouds to devour our metal shuttles.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SO',
      'subtypes'  => [LEVIATHAN],
      'effectDesc' => clienttranslate('$<GIGANTIC>.  {J} You may discard any number of cards from your Reserve to give me that many boosts.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 5,
      'costReserve' => 4,
      'gigantic' => true,
      'effectPlayed' => FT::ACTION(DISCARD_DO, ['effect' => FT::GAIN(ME, BOOST, 'X')]),

    ];
  }
}
