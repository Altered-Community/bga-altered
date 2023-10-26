<?php
namespace ALT\Cards\YZ;

class YZ_Common_LadyoftheLake extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '166',
      'asset' => 'YZ-06_Nimue_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Lady of the Lake'),
      'type' => CHARACTER,
      'subtype' => 'Spirit',
      'typeline' => 'Common - Spirit',
      'rarity' => RARITY_COMMON,

      'forest' => 1,
      'mountain' => 1,
      'ocean' => 3,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
