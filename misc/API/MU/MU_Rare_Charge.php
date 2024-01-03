<?php
namespace ALT\Cards\MU;

class MU_Rare_Charge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_23_R2',
      'asset' => 'ALT_CORE_B_OR_23_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Charge!'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        'Characters you control gain 1 boost[]. (A boost is a +1/+1/+1 counter. Remove it when it leaves the Expedition zone.)'
      ),
      'costHand' => 2,
      'costReserve' => 3,
    ];
  }
}
