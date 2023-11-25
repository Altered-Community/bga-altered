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
      'name' => clienttranslate('Ozma'),
      'type' => CHARACTER,
      'subtype' => [CITIZEN],
      'effectDesc' => clienttranslate('{J} If you have at least 3 other Characters in your Expeditions, draw a card.'),
      'forest' => 1,
      'mountain' => 2,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'control3OtherCharacters',
        'effect' => FT::ACTION(DRAW, ['players' => ME]),
      ]),
    ];
  }
}
