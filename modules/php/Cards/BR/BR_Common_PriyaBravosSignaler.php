<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_PriyaBravosSignaler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_74_C',
      'asset'  => 'ALT_CYCLONE_B_BR_74_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Priya, Bravos Signaler"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"The goal is simple: to draw out Halua!" - Sol'),
      'artist' => "DOBA",
      'extension' => 'SO',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('When my Expedition moves forward — Create an <AEROLITH> token in your Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")'),
      'forest' => 3,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 4,
      'costReserve' => 4,
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
