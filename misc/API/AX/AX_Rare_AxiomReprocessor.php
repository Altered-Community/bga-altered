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
      'name' => clienttranslate('Axiom Reprocessor'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'flavorText' => clienttranslate('Nothing is created, nothing is lost, everything is transformed.'),
      'effectDesc' => clienttranslate('{J} [Resupply].  At Noon — [Resupply]. (Put the top card of your deck in Reserve.)'),
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
