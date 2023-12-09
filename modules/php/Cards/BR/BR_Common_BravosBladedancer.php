<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_BravosBladedancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_16_C',
      'asset' => 'ALT_CORE_B_BR_16_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Bravos Bladedancer'),
      'type' => CHARACTER,
      'subtype' => ADVENTURER,
      'effectDesc' => clienttranslate('{J} I gain 1 boost.  $[SEASONED]'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 3,

      'seasoned' => true,
      'effectPlayed' => FT::GAIN($this, BOOST),
    ];
  }
}
