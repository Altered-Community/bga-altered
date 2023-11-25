<?php

namespace ALT\Cards\AX;

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
      'subtype' => [LANDMARK],
      'effectDesc' => clienttranslate('#{J} $[RESUPPLY].#  At Dawn — Activate my {J} effect.'),
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
