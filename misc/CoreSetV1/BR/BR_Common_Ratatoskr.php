<?php

namespace ALT\Cards\BR;

class BR_Common_Ratatoskr extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_04_C',
      'asset' => 'ALT_CORE_B_BR_04_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ratatoskr'),
      'type' => CHARACTER,
      'subtype' => SQUIRREL,
      'effectDesc' => clienttranslate('{S} I gain 2 boosts.  '),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
