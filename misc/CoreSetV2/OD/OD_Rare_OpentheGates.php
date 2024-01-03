<?php
namespace ALT\Cards\OD;

class OD_Rare_OpentheGates extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_26_R1',
      'asset' => 'ALT_CORE_B_OR_26_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Open the Gates'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        'Create #four# [ORDIS_RECRUIT] Soldier tokens, distributed as you choose among any number of target Expeditions.'
      ),
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['costReserve'],
    ];
  }
}
