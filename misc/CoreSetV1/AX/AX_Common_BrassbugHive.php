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
      'type' => PERMANENT,
      'subtype' => LANDMARK,
      'effectDesc' => clienttranslate('{J} Create a [BRASSBUG] Robot token.  At Dawn — Activate my {J} effect.  '),
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}
