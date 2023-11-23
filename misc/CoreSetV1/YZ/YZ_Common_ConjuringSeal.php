<?php

namespace ALT\Cards\YZ;

class YZ_Common_ConjuringSeal extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_23_C',
      'asset' => 'ALT_CORE_B_YZ_23_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Conjuring Seal'),
      'type' => SPELL,
      'subtype' => SUPPORT,
      'effectDesc' => clienttranslate('Draw 2 cards.  '),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
