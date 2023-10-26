<?php
namespace ALT\Cards\AX;

class AX_Common_BrassbugHive extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '26',
      'asset' => 'AX-49_Brassbug Queen_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Brassbug Hive'),
      'type' => PERMANENT,
      'subtype' => '',
      'typeline' => '',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{J} Create a [2/2/2 Brassbug] Robot token.  At Dawn�� Activate my {J} effect.'),
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}
