<?php
namespace ALT\Cards\AX;

class AX_Common_MechanicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_22_C',
      'asset' => 'ALT_CORE_B_AX_22_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Mechanical Training'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate('Activate the {J} triggers of target Permanent you control.'),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
