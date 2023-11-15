<?php
namespace ALT\Cards\YZ;

class YZ_Common_YzmirStargazer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_08_C',
      'asset' => 'ALT_CORE_B_YZ_08_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Yzmir Stargazer'),
      'type' => CHARACTER,
      'subtype' => MAGE,
      'forest' => 1,
      'mountain' => 2,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}
