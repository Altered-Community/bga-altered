<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_AxiomReprocessor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_25_R',
      'asset' => 'ALT_CORE_B_AX_25_R',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Axiom Reprocessor',
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => '#{J} <RESUPPLY>.#  At Noon — $<RESUPPLY>.',
      'flavorText' => 'Nothing is created, nothing is lost, everything is transformed.',
      'typeline' => 'Permanent - Landmark',
      'artist' => 'HuoMiao Studio',

      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::ACTION(RESUPPLY, []),
      'effectPassive' => [
        'Noon' => [
          'condition' => 'myTurn',
          'output' => FT::ACTION(RESUPPLY, []),
        ],
      ],
    ];
  }
}
