<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_AxiomReprocessor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_25_C',
      'asset' => 'ALT_CORE_B_AX_25_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Axiom Reprocessor'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('At Noon — $<RESUPPLY>.'),
      'flavorText' => clienttranslate('Nothing is created, nothing is lost, everything is transformed.'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'artist' => 'HuoMiao Studio',

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
