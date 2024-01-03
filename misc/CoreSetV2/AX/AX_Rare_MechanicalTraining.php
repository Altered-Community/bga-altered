<?php
namespace ALT\Cards\AX;

class AX_Rare_MechanicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_22_R1',
      'asset' => 'ALT_CORE_B_AX_22_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Mechanical Training'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'flavorText' => clienttranslate('To learn to create, first learn to fix.'),
      'effectDesc' => clienttranslate('Activate the {j} triggers of #up to two# target Permanents you control.'),
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costHand'],
    ];
  }
}
