<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_ALTAxiomReprocessor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_25_R1',
      'asset' => 'ALT_CORE_B_AX_25_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('ALT Axiom Reprocessor'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('#{J} $[RESUPPLY].#  At Dawn — Activate my {J} effect.'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::ACTION(RESUPPLY, []),
      'effectPassive' => [
        'Dawn' => [
          'condition' => 'myTurn',
          'output' => FT::ACTION(RESUPPLY, []),
        ],
      ],
    ];
  }
}
