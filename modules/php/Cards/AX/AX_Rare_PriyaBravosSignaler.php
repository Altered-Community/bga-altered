<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_PriyaBravosSignaler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_74_R2',
      'asset'  => 'ALT_CYCLONE_B_BR_74_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Priya, Bravos Signaler"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"The goal is simple: to draw out Halua!" - Sol'),
      'artist' => "DOBA",
      'extension' => 'SO',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('#<TOUGH_1>.# (Opponents must pay {1} to target me.)  When my Expedition moves forward — Create an <AEROLITH> token in your Landmarks.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['forest'],
      'tough' => 1,
      'effectPassive' => [
        'AfterDusk' => [
          'condition' => 'myExpeditionHasMoved',
          'output' =>  FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'NE_Common_Aerolith',
            'targetLocation' => [LANDMARK],
          ]),
        ],
        'MoveExpedition' => [
          'condition' => 'myExpeditionHasMoved',
          'output' =>  FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'NE_Common_Aerolith',
            'targetLocation' => [LANDMARK],
          ]),
        ],
      ],
    ];
  }
}
