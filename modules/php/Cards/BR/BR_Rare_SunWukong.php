<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_SunWukong extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_18_R1',
      'asset' => 'ALT_CORE_B_BR_18_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Sun Wukong'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate('{R} I gain 2 boosts$[BB] #and lose [FLEETING_CHAR]#.'),
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 4,
      'effectReserve' => FT::SEQ(FT::GAIN($this, BOOST, 2), FT::LOOSE($this, FLEETING)),
      'typeline' => clienttranslate('Character - Deity'),
    ];
  }
}
