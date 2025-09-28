<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_StickyShroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_67_R2',
      'asset'  => 'ALT_CYCLONE_B_LY_67_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Sticky Shroom"),
      'typeline' => clienttranslate("Character - Plant"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('He\'s a fun guy, but he can get into some sticky situations.'),
      'artist' => "Khoa Viet",
      'extension' => 'SO',
      'subtypes'  => [PLANT],
      'effectDesc' => clienttranslate('{J} I gain <ANCHORED>.  #At Noon — If I\'m in {V}, create an <AEROLITH> token in target player\'s Landmarks.#'),
      'forest' => 2,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::GAIN(ME, ANCHORED),
      'effectPassive' => [
        'Noon' => [
          'condition' => 'isInBiome:forest',
          'output' =>  [
            'action' => INVOKE_TOKEN,
            'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK], 'allPlayers' => true],
          ],
        ]
      ]
    ];
  }
}
