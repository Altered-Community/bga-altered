<?php

namespace ALT\Cards\BR;

class BR_Common_HavenWarrior extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_17_C',
      'asset' => 'ALT_CORE_B_BR_17_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Haven Veteran'),
      'type' => CHARACTER,
      'subtypes' => [BLADEMASTER],
      'forest' => 4,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
