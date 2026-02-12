<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_HostelNightkeeper extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_LY_95_R2',
      'asset'  => 'ALT_DUSTER_B_LY_95_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Hostel Nightkeeper"),
      'typeline' => clienttranslate("Character - Merchant"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Floor -2, room 217. Welcome to the Underlook Hostel."'),
      'artist' => "Anh Tung",
      'extension' => 'SDU',
      'subtypes'  => [MERCHANT],
      'effectDesc' => clienttranslate('{H} You may target a Character. If you do, it gains <ASLEEP>, then create a <MANASEED> token in its controller\'s Landmarks.'),
      'forest' => 4,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 3,
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER],
        'upTo' => true,
        'effect' => FT::SEQ(
          FT::GAIN(EFFECT, ASLEEP),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'NE_Common_Manaseed',
            'targetLocation' => ['discardedSource'],
            'forcedLocation' => LANDMARK,
            'targetPlayer' => 'owner'
          ]),
        )
      ]),
    ];
  }
}
