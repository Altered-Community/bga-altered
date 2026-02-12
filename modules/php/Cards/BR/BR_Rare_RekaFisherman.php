<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_RekaFisherman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_94_R1',
      'asset'  => 'ALT_DUSTER_B_BR_94_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Fisherman"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Haha, check it out, it\'s already stuffed!"'),
      'artist' => "Victor Canton",
      'extension' => 'SDU',
      'subtypes'  => [CITIZEN],
      'effectDesc' => clienttranslate('#{R} Draw a card.#  {R} Create two <MANASEED> tokens in your Landmarks.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 5,
      'changedStats' => ['forest', 'mountain'],
      'effectReserve' => [
        'childs' => [
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'n' => 2,
            'tokenType' => 'NE_Common_Manaseed',
            'targetLocation' => [LANDMARK],
          ]),
          FT::ACTION(DRAW, ['players' => ME])
        ]
      ]
    ];
  }
}
