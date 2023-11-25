<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_ALTConiferalConeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_20_R1',
      'asset' => 'ALT_CORE_B_MU_20_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('ALT Coniferal Coneman'),
      'type' => CHARACTER,
      'subtype' => [PLANT],
      'effectDesc' => clienttranslate('{J} I become $[ANCHORED].'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::GAIN($this, ANCHORED),
    ];
  }
}
