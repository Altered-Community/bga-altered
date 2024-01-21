<?php

namespace ALT\Cards\BR;

class BR_Common_Kappa extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_13_C',
      'asset' => 'ALT_CORE_B_BR_13_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kappa'),
      'type' => CHARACTER,
      'subtypes' => [SPIRIT, TRAINER],
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 5,
      'costHand' => 4,
      'costReserve' => 4,
      'typeline' => clienttranslate('Character - Spirit Trainer'),
      'flavorText' => clienttranslate("\"Push through the pain. Giving up would hurt far more.\""),
      'artist' => 'Matteo Spirito',
    ];
  }
}
