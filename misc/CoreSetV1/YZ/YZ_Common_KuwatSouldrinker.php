<?php

namespace ALT\Cards\YZ;

class YZ_Common_KuwatSouldrinker extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_15_C',
      'asset' => 'ALT_CORE_B_YZ_15_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kuwat, Souldrinker'),
      'type' => CHARACTER,
      'subtype' => MAGE,
      'effectDesc' => clienttranslate('{J} Sacrifice a Character from my Expedition.  '),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
