<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_OuroborosCroupier extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_17_C',
      'asset' => 'ALT_CORE_B_LY_17_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ouroboros Croupier'),
      'type' => CHARACTER,
      'typeline' => clienttranslate('Character - Citizen'),
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate('{H} Roll a die. On a 4 or higher, draw a card. Otherwise, $[RESUPPLY].'),
      'forest' => 0,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
      'effectHand' => FT::ACTION(ROLL_DIE, [
        'effect' => [
          '1-3' => FT::ACTION(RESUPPLY, []),
          '4+' => FT::ACTION(DRAW, ['players' => ME]),
        ],
      ]),
    ];
  }
}
