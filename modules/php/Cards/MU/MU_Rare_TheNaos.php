<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_TheNaos extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_102_R1',
      'asset'  => 'ALT_DUSTER_B_MU_102_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("The Naos"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Patiently, the Reka waited for their new world tree to grow.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SDU',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('<TOUGH_1>.  #{J} Target Expedition can\'t move forward this Day.#  At Noon — Draw a card, then create two <MANASEED> tokens in your Landmarks.'),
      'costHand' => 8,
      'costReserve' => 8,
      'changedStats' => ['costHand', 'costReserve'],
      'tough' => 1,
      'effectPassive' => [
        'Noon' => [
          'condition' => 'isMe',
          'output' => FT::SEQ(
            FT::ACTION(DRAW, ['players' => ME]),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'n' => 2,
              'tokenType' => 'NE_Common_Manaseed',
              'targetLocation' => [LANDMARK],
            ]),
          )
        ]
      ],
      'effectPlayed' => FT::ACTION(BLOCK_EXPEDITION, [])
    ];
  }
}
