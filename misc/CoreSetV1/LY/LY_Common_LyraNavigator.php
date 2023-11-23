<?php

namespace ALT\Cards\LY;

class LY_Common_LyraNavigator extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_06_C',
      'asset' => 'ALT_CORE_B_LY_06_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Lyra Navigator'),
      'type' => CHARACTER,
      'subtype' => CITIZEN,
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
