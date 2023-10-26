<?php
namespace ALT\Cards\YZ;

class YZ_Common_YzmirStargazer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '169',
      'asset' => 'YZ-40_Kadigiran_Phonomancer_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Yzmir Stargazer'),
      'type' => CHARACTER,
      'subtype' => 'Mage',
      'typeline' => 'Common - Mage',
      'rarity' => RARITY_COMMON,

      'forest' => 2,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
