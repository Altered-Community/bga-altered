<?php
namespace ALT\Cards\BR;

class BR_Rare_HavenBravosBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_30_R1',
      'asset' => 'ALT_CORE_B_BR_30_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Haven, Bravos Bastion'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('#{J} $[RESUPPLY].#  Your Characters have: \"{R} I gain 1 boost.\"'),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
