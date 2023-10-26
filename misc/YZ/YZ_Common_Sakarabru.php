<?php
namespace ALT\Cards\YZ;

class YZ_Common_Sakarabru extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '182',
      'asset' => 'YZ-07_SakarMoonhealer_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Sakarabru'),
      'type' => CHARACTER,
      'subtype' => 'Divinity',
      'typeline' => 'Common - Divinity',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{M} The Expedition opposing me moves one step back.'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 7,
      'costMemory' => 7,
    ];
  }
}
