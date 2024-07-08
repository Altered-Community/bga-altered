<?php

namespace ALT\Cards\LY;

class LY_Rare_Kappa extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_13_R2',
      'asset' => 'ALT_CORE_B_BR_13_R',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kappa'),
      'typeline' => clienttranslate('Character - Trainer Spirit'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('"Push through the pain. Giving up would hurt far more."'),
      'artist' => 'Matteo Spirito',
      'subtypes' => [TRAINER, SPIRIT],
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 5,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
