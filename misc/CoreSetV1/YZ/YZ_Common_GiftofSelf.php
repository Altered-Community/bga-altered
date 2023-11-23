<?php

namespace ALT\Cards\YZ;

class YZ_Common_GiftofSelf extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_20_C',
      'asset' => 'ALT_CORE_B_YZ_20_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Gift of Self'),
      'type' => SPELL,
      'subtype' => SUPPORT,
      'effectDesc' => clienttranslate('$[FLEETING].  Sacrifice a Character to draw 2 cards.  '),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
