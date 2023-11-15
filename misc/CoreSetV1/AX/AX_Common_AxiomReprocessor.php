<?php
namespace ALT\Cards\AX;

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
      'subtype' => LANDMARK,
      'effectDesc' => clienttranslate('At Dawn — $[RESUPPLY].  '),
      'costHand' => 4,
      'costMemory' => 4,
    ];
  }
}
