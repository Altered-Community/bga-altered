<?php

namespace ALT\Cards\YZ;

class YZ_Common_LadyoftheLake extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_09_C',
      'asset' => 'ALT_CORE_B_YZ_09_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Lady of the Lake'),
      'type' => CHARACTER,
      'subtype' => SPIRIT,
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
