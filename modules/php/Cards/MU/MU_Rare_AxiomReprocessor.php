<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_AxiomReprocessor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_25_R2',
      'asset' => 'ALT_CORE_B_AX_25_R',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Axiom Reprocessor',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => 'Nothing is created, nothing is lost, everything is transformed.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [LANDMARK],
      'effectDesc' => 'At Noon — $<RESUPPLY>.',
      'costHand' => 4,
      'costReserve' => 4,
      'effectPassive' => [
        'Noon' => [
          'condition' => 'myTurn',
          'output' => FT::ACTION(RESUPPLY, []),
        ],
      ],
    ];
  }
}
