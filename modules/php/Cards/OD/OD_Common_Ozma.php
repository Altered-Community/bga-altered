<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_Ozma extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_11_C',
      'asset' => 'ALT_CORE_B_OR_11_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'Ozma',
      'type' => CHARACTER,
      'subtypes' => [NOBLE],
      'effectDesc' => '{J} If you control three or more other Characters, draw a card. (Cards in Reserve are not controlled.)',
      'typeline' => 'Character - Noble',
      'flavorText' => '"Never give up. No one knows what’s going to happen next."',
      'artist' => 'Taras Susak',

      'forest' => 1,
      'mountain' => 2,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'hasControl::3:true',
        'effect' => FT::ACTION(DRAW, ['players' => ME]),
      ]),
    ];
  }
}
