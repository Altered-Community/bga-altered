<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_BabasIsba extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_28_R2',
      'asset' => 'ALT_CORE_B_YZ_28_R',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => "Baba's Isba",
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => 'Boney Legs, she\'s called, and her hut is one reason why.',
      'artist' => 'Taras Susak',
      'subtypes' => [LANDMARK],
      'effectDesc' => '{J} Draw a card.  {T}, Sacrifice a Character: $<AFTER_YOU>.',
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(DRAW, ['players' => ME]),
      'effectTap' =>
      FT::ACTION(CHECK_CONDITION, [
        'condition' => 'controlCharacters', 'effect' => FT::SEQ(
          FT::ACTION(
            TARGET,
            [
              'targetPlayer' => ME,
              'targetType' => [CHARACTER, TOKEN],
              'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice'])
            ]
          ),
          FT::ACTION(AFTER_YOU, [])
        )
      ])
    ];
  }
}
