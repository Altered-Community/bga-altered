<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Medusa extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_71_R2',
      'asset'  => 'ALT_CYCLONE_B_AX_71_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Medusa"),
      'typeline' => clienttranslate("Character - Deity"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('They made her a monster simply for defending herself.'),
      'artist' => "Nestor Papatriantafyllou",
      'extension' => 'SO',
      'subtypes'  => [DEITY],
      'effectDesc' => clienttranslate('{R} You may discard target Character. If you do, create an <AEROLITH> token in its controller\'s Landmarks.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 5,
      'effectReserve' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, TOKEN, PERMANENT],
        'upTo' => true,
        'effect' => FT::SEQ(
          FT::ACTION(DISCARD, []),
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'NE_Common_Aerolith',
            'targetLocation' => [LANDMARK],
            'targetPlayer' => 'owner'
          ]),
        )
      ])
    ];
  }
}
