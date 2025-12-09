<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Hesperide extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_93_R2',
      'asset'  => 'ALT_DUSTER_B_MU_93_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Hesperide"),
      'typeline' => clienttranslate("Character - Fairy"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"No matter what they say, the Naos is suffering, just like the Nilam before it!"'),
      'artist' => "Zael",
      'extension' => 'SDU',
      'subtypes'  => [FAIRY],
      'effectDesc' => clienttranslate('{H} You may return target Permanent to its owner\'s hand. #If you do, create a <MANASEED> token in its controller\'s Landmarks.#'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'changedStats' => ['forest', 'costHand'],
      'effectHand' =>
      FT::ACTION(TARGET, [
        'targetType' => [PERMANENT],
        'targetLocation' => [STORM_LEFT, STORM_RIGHT, LANDMARK],
        'upTo' => true,
        'effect' => FT::SEQ(
          FT::RETURN_TO_HAND(),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'NE_Common_Manaseed',
            'targetLocation' => ['discardedSource'],
            'forcedLocation' => LANDMARK
          ]),
        )
      ])
    ];
  }
}
