<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_ALTBravosTracer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_07_R1',
      'asset' => 'ALT_CORE_B_BR_07_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('ALT Bravos Tracer'),
      'type' => CHARACTER,
      'subtype' => [ADVENTURER],
      'effectDesc' => clienttranslate('{J} I become $[FLEETING_CHAR].'),
      'forest' => 4,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'ocean'],
      'effectPlayed' => FT::GAIN($this, FLEETING),
    ];
  }
}
