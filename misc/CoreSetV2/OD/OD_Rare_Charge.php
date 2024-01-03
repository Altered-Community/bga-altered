<?php
namespace ALT\Cards\OD;

class OD_Rare_Charge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_23_R1',
      'asset' => 'ALT_CORE_B_OR_23_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Charge!'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate('Characters you control gain 1 boost$[BB].'),
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costReserve'],
    ];
  }
}
