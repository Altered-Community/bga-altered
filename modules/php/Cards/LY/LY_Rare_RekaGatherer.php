<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_RekaGatherer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_94_R2',
      'asset'  => 'ALT_DUSTER_B_MU_94_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Gatherer"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('There always comes a time to reap what we sow.'),
      'artist' => "Bastien Jez",
      'extension' => 'SDU',
      'subtypes'  => [CITIZEN],
      'effectDesc' => clienttranslate('#At Noon — Create a <MANASEED> token in your Landmarks.#'),
      'supportDesc' => clienttranslate('{D} : Create a <MANASEED> token in each player\'s Landmarks.'),
      'supportIcon' => 'discard',
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest'],
      'effectSupport' => FT::SEQ(
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'NE_Common_Manaseed',
          'targetLocation' => [LANDMARK],
        ]),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'NE_Common_Manaseed',
          'targetLocation' => [LANDMARK],
          'targetPlayer' => OPPONENT
        ]),
      ),
      'effectPassive' => [
        'Noon' => [
          'condition' => 'isMe',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'NE_Common_Manaseed',
            'targetLocation' => [LANDMARK],
          ]),
        ]
      ]
    ];
  }
}
