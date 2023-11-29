<?php
namespace ALT\Cards\AX;

class AX_Common_BrassbugHive extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_30_C',
      'asset' => 'ALT_CORE_B_AX_30_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Brassbug Hive'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{J} Create a [Brassbug 2/2/2] Robot token in target Expedition.  At Noon — Create a [Brassbug 2/2/2] Robot token in target Expedition.'
      ),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
