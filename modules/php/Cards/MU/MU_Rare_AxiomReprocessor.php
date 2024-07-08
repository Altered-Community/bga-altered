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
      'name' => clienttranslate('Axiom Reprocessor'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'flavorText' => clienttranslate('Nothing is created, nothing is lost, everything is transformed.'),
      'artist' => 'HuoMiao Studio',
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('At Noon — $<RESUPPLY>.'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectPassive' => [
        'Noon' => [
          'condition' => 'isMe',
          'output' => FT::ACTION(RESUPPLY, []),
        ],
      ],
    ];
  }
}
