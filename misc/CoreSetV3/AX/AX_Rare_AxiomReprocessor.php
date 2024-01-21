<?php
namespace ALT\Cards\AX;

class AX_Rare_AxiomReprocessor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_25_R1',
      'asset' => 'ALT_CORE_B_AX_25_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Axiom Reprocessor',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => 'Nothing is created, nothing is lost, everything is transformed.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [LANDMARK],
      'effectDesc' => '#{J} [RESUPPLY].#  At Noon — $[RESUPPLY].',
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
