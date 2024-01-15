<?php
namespace ALT\Cards\MU;

class MU_Rare_BeautySleep extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_28_R1',
      'asset' => 'ALT_CORE_B_MU_28_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Beauty Sleep'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        'Target Character gains [[Asleep]]. You may give it 2 boosts. (During Dusk, ignore its statistics. During Rest, it doesn\'t go to Reserve and it loses Asleep.)'
      ),
      'costHand' => 1,
      'costReserve' => 3,
    ];
  }
}
