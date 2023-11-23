<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_SunWukong extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_18_C',
      'asset' => 'ALT_CORE_B_BR_18_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Sun Wukong'),
      'type' => CHARACTER,
      'subtype' => DIVINITY,
      'effectDesc' => clienttranslate('{S} I gain 2 boosts.  '),
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
      'effectReserve' => FT::GAIN($this, BOOST, 2),
    ];
  }
}
