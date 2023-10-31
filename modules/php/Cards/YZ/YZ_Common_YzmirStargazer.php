<?php
namespace ALT\Cards\YZ;

class YZ_Common_YzmirStargazer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '169',
      'asset' => 'YZ-40-Kadigiran-Phonomancer-C',
      'frameSize' => 1,

      'faction' => FACTION_YZ,
      'name' => clienttranslate('Yzmir Stargazer'),
      'typeline' => clienttranslate('Common - Mage'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Mage',

      'forest' => 2,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
