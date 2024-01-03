<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_ALTSneezerShroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_08_R1',
      'asset' => 'ALT_CORE_B_MU_08_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('ALT Sneezer Shroom'),
      'type' => CHARACTER,
      'subtypes' => [PLANT],
      'effectDesc' => clienttranslate('{J} I become $[ANCHORED].  #At Dawn — I gain 1 boost.#'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::GAIN($this, ANCHORED),
      'effectPassive' => ['Dawn' => ['condition' => 'myTurn', 'output' => FT::GAIN($this, BOOST)]],
    ];
  }
}
