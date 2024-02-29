<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Ozma extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_11_R2',
      'asset' => 'ALT_CORE_B_OR_11_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Ozma',
      'typeline' => 'Character - Noble',
      'type' => CHARACTER,
      'flavorText' => '"Never give up. No one knows what’s going to happen next."',
      'artist' => 'Taras Susak',
      'subtypes' => [NOBLE],
      'effectDesc' => '{J} If you control #two or more other <BOOSTED_CHA_P># Characters, draw a card.',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'ocean'],
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'control2BoostedOtherCharacters',
        'effect' => FT::ACTION(DRAW, ['players' => ME]),
      ]),
    ];
  }
}
