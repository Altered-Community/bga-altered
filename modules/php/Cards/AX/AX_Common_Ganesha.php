<?php
namespace ALT\Cards\AX;

class AX_Common_Ganesha extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '12',
      'asset' => 'AX-19-Ganesha-C',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Ganesha'),
      'typeline' => clienttranslate('Common - Divinity'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Divinity',

      'effectDesc' => clienttranslate('{J} Create a [2/2/2 Brassbug] Robot token for each Permanent you control.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 7,
      'costMemory' => 7,
    ];
  }
}
