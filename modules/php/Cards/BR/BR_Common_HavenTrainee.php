<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_HavenTrainee extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_09_C',
      'asset' => 'ALT_CORE_B_BR_09_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Haven Trainee'),
      'type' => CHARACTER,
      'subtypes' => [APPRENTICE],
      'effectDesc' => clienttranslate('{R} I gain 2 boosts$[BB].'),
      'forest' => 3,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 4,
      'effectReserve' => FT::GAIN($this, BOOST, 2),
      'typeline' => clienttranslate('Character - Apprentice'),
    ];
  }
}
