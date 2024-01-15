<?php
namespace ALT\Cards\OD;

class OD_Rare_BrassbugHub extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_24_R2',
      'asset' => 'ALT_CORE_B_AX_24_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Brassbug Hub'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'flavorText' => clienttranslate(
        'Few people visit the depths of the Foundry, and even fewer can explain how the Brassbugs came to be.'
      ),
      'effectDesc' => clienttranslate(
        '{J} I gain three Kelon counters.  At Noon — You may pay {1} and spend one of my Kelon counters to create a [BRASSBUG] Robot token in target Expedition.'
      ),
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costHand', 'costReserve'],
    ];
  }
}
