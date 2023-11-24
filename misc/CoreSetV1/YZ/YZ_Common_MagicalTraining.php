<?php

namespace ALT\Cards\YZ;

class YZ_Common_MagicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_19_C',
      'asset' => 'ALT_CORE_B_YZ_19_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Magical Training'),
      'type' => SPELL,
      'subtype' => SUPPORT,
      'effectDesc' => clienttranslate('Draw a card.'),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
