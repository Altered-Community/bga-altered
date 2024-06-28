<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_SneezerShroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_08_R2',
      'asset' => 'ALT_CORE_B_MU_08_R',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Sneezer Shroom',
      'typeline' => 'Character - Plant',
      'type' => CHARACTER,
      'flavorText' => '"Achoo!"',
      'artist' => 'Zero Wen',
      'subtypes' => [PLANT],
      'effectDesc' => '{J} I gain $<ANCHORED>.  #At Noon — I gain 1 boost.#',
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::GAIN($this, ANCHORED),
      'effectPassive' => ['Noon' => ['condition' => 'myTurn', 'output' => FT::GAIN($this, BOOST)]],
    ];
  }
}
