<?php

namespace ALT\Cards\YZ;

class YZ_Common_Sakarabru extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_18_C',
      'asset' => 'ALT_CORE_B_YZ_18_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Sakarabru'),
      'type' => CHARACTER,
      'subtype' => DIVINITY,
      'effectDesc' => clienttranslate('{M} Your opponent\'s Expedition facing mine moves backwards.  '),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}
