<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_WingedMonkey extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_67_R1',
      'asset'  => 'ALT_CYCLONE_B_YZ_67_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Winged Monkey"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Flight should always mean freedom.'),
      'artist' => "Anh Tung",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{H} I gain 2 boosts, #then create an <AEROLITH> token in target player\'s Landmarks.#'),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 1,
      'effectHand' => FT::SEQ(
        FT::GAIN(ME, BOOST, 2),
        [
          'action' => INVOKE_TOKEN,
          'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK], 'allPlayers' => true],
        ],
      )
    ];
  }
}
