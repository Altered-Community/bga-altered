<?php
namespace ALT\Cards\YZ;

class YZ_Rare_BeautySleep extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_28_R2',
      'asset' => 'ALT_CORE_B_MU_28_R2',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Beauty Sleep'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        'Target Character gains [[Asleep]]. (During Dusk, ignore its statistics. During Rest, it doesn\'t go to Reserve and it loses Asleep.)'
      ),
      'costHand' => 1,
      'costReserve' => 3,
    ];
  }
}
