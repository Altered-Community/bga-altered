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
      'name' => 'Hua Mulan',
      'type' => CHARACTER,
      'subtypes' => [ADVENTURER],
      'effectDesc' => '{R} I lose [FLEETING_CHAR].',
      'typeline' => 'Character - Adventurer',
      'flavorText' => 'Her determination has yet to meet its match in this world.',
      'artist' => 'Zero Wen',

      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectReserve' => FT::LOOSE($this, FLEETING),
    ];
  }
}
