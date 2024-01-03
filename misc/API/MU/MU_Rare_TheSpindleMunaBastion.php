<?php
namespace ALT\Cards\MU;

class MU_Rare_TheSpindleMunaBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_30_R1',
      'asset' => 'ALT_CORE_B_MU_30_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Spindle, Muna Bastion'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        'Characters you control have [Tough 2]. (Your opponent\'s Spells and abilities that target me cost {2} more.)  At Noon — Target Character you control gains 1 boost.'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
