<?php
namespace ALT\Cards\BR;

class BR_Common_HavenBravosBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_30_C',
      'asset' => 'ALT_CORE_B_BR_30_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Haven, Bravos Bastion'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('Your Characters have: "{R} I gain 1 boost$[BB]."'),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
