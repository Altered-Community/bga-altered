<?php

namespace ALT\Cards\YZ;

class YZ_Common_KadigiranMageDancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_07_C',
      'asset' => 'ALT_CORE_B_YZ_07_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kadigiran Mage-Dancer'),
      'type' => CHARACTER,
      'subtype' => MAGE,
      'effectDesc' => clienttranslate('Whenever you play a Spell — I gain 1 boost.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
