<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_HuaMulan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_12_C',
      'asset' => 'ALT_CORE_B_BR_12_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Hua Mulan'),
      'type' => CHARACTER,
      'subtype' => [ADVENTURER],
      'effectDesc' => clienttranslate('{S} I lose [FLEETING_CHAR].'),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectReserve' => FT::LOOSE($this, FLEETING)
    ];
  }
}
