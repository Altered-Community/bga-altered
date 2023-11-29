<?php
namespace ALT\Cards\MU;

class MU_Common_BeautySleep extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_28_C',
      'asset' => 'ALT_CORE_B_MU_28_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Beauty Sleep'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        'Target Character gains [[Asleep]]. (Ignore my statistics during Dusk. At Night, I don\'t go to Reserve and I lose Asleep.)'
      ),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
