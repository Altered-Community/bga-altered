<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_Gavroche extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_66_R1',
      'asset'  => 'ALT_CYCLONE_B_AX_66_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Gavroche"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('He fills his basket and retorts by thumbing his nose.'),
      'artist' => "Anh Tung",
      'extension' => 'SO',
      'subtypes'  => [CITIZEN],
      'effectDesc' => clienttranslate('{R} #You may sacrifice a Permanent to# create an <AEROLITH> token in your Landmarks.'),
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
      'changedStats' => ['costReserve'],
      'effectReserve' => FT::ACTION(TARGET, [
        'targetPlayer' => ME,
        'targetType' => [PERMANENT],
        'upTo' => true,
        'effect' => FT::SEQ(
          FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'NE_Common_Aerolith',
            'targetLocation' => [LANDMARK],
          ]),
        ),
      ])
    ];
  }
}
