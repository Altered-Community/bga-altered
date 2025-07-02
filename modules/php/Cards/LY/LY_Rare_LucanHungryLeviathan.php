<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_LucanHungryLeviathan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_74_R2',
      'asset'  => 'ALT_CYCLONE_B_AX_74_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Lucan, Hungry Leviathan"),
      'typeline' => clienttranslate("Character - Leviathan"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('It bursts out of the clouds to devour our metal shuttles.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SO',
      'subtypes'  => [LEVIATHAN],
      'effectDesc' => clienttranslate('<GIGANTIC>.  {J} You may discard any number of cards from your Reserve to give me that many boosts.'),
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
