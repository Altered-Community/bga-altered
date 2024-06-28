<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_AmeliaEarhart extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_11_R',
      'asset' => 'ALT_CORE_B_AX_11_R',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Amelia Earhart',
      'typeline' => 'Character - Adventurer',
      'type' => CHARACTER,
      'flavorText' => '"The most effective way to do it, is to do it."',
      'artist' => 'Taras Susak',
      'subtypes' => [ADVENTURER],
      'effectDesc' => '#{H} I gain 1 boost$<BB>.#',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 1,
      'effectHand' => FT::GAIN($this, BOOST)
    ];
  }
}
