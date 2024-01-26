<?php

namespace ALT\Cards\BR;

class BR_Common_Atlas extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_20_C',
      'asset' => 'ALT_CORE_B_BR_20_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Atlas'),
      'type' => CHARACTER,
      'subtypes' => [TITAN],
      'effectDesc' => clienttranslate('$[GIGANTIC].'),
      'flavorText' => clienttranslate('Not even the weight of the sky could make him buckle.'),
      'artist' => 'Matteo Spirito',

      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costReserve' => 5,
      'typeline' => clienttranslate('Character - Titan'),
      'gigantic' => true,
    ];
  }
}
