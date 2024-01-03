<?php
namespace ALT\Cards\MU;

class MU_Rare_MechanicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_22_R2',
      'asset' => 'ALT_CORE_B_AX_22_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Mechanical Training'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate('Activate the {j} triggers of target #Character# you control.'),
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costHand'],
    ];
  }
}
