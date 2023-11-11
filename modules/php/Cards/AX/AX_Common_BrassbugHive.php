<?php
namespace ALT\Cards\AX;

class AX_Common_BrassbugHive extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '26',
      'asset' => 'AX-30-BrassbugQueen-C',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Brassbug Hive'),
      'typeline' => '',
      'rarity' => RARITY_COMMON,
      'type' => PERMANENT,
      'subtype' => '',

      'effectDesc' => clienttranslate('{J} Create a [2/2/2 Brassbug] Robot token.  At Dawn - Activate my {J} effect.'),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
