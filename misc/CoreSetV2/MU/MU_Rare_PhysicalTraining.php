<?php
namespace ALT\Cards\MU;

class MU_Rare_PhysicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_26_R2',
      'asset' => 'ALT_CORE_B_BR_26_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Physical Training'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate('Target Character gains 3 boosts$[BB].'),
      'costHand' => 2,
      'costReserve' => 3,
    ];
  }
}
