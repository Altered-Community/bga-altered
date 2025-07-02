<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_LucanHungryLeviathan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_74_R1',
      'asset'  => 'ALT_CYCLONE_B_AX_74_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Lucan, Hungry Leviathan"),
      'typeline' => clienttranslate("Character - Leviathan"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('It bursts out of the clouds to devour our metal shuttles.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SO',
      'subtypes'  => [LEVIATHAN],
      'effectDesc' => clienttranslate('<GIGANTIC>, #<TOUGH_1>.# (Opponents must pay {1} to target me.)  {J} You may #sacrifice# any number of #Permanents# to give me that many boosts.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['costReserve'],
      'gigantic' => true,
      'tough' => 1,
      'effectPlayed' => FT::ACTION(DISCARD_DO, [
        'sacrifice' => true,
        'targetType' => [PERMANENT],
        'targetLocation' => IN_PLAY,
        'effect' => FT::GAIN(ME, BOOST, 'X')
      ]),

    ];
  }
}
