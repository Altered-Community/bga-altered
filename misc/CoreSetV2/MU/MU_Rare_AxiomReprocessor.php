<?php
namespace ALT\Cards\MU;

class MU_Rare_AxiomReprocessor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_25_R2',
      'asset' => 'ALT_CORE_B_AX_25_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Axiom Reprocessor'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('At Noon — $[RESUPPLY].'),
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
