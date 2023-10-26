<?php
namespace ALT\Cards\YZ;

class YZ_Rare_DorothyGale extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '193',
      'asset' => 'YZ-13_DorotyGale_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Dorothy Gale'),
      'type' => CHARACTER,
      'subtype' => 'Citizen',
      'typeline' => 'Rare - Citizen',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate('<{J}> Send to Reserve target Character.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}
