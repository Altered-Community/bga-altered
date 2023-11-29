<?php
namespace ALT\Cards\AX;

class AX_Common_BrassbugHub extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_24_C',
      'asset' => 'ALT_CORE_B_AX_24_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Brassbug Hub'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{J} I gain three Kelon counters.  At Noon — You may pay {1} and spend one of my Kelon counters to create a [Brassbug 2/2/2] Robot token in target Expedition.'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
