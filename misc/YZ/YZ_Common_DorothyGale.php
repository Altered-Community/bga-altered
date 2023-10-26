<?php
namespace ALT\Cards\YZ;

class YZ_Common_DorothyGale extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '180',
      'asset' => 'YZ-13_DorotyGale_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Dorothy Gale'),
      'type' => CHARACTER,
      'subtype' => 'Citizen',
      'typeline' => 'Common - Citizen',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{M} Send to Reserve target Character.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}
