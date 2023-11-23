<?php

namespace ALT\Cards\BR;

class BR_Common_HavenBouncer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_15_C',
      'asset' => 'ALT_CORE_B_BR_15_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Haven Bouncer'),
      'type' => CHARACTER,
      'subtype' => ADVENTURER,
      'effectDesc' => clienttranslate('{M} $[SABOTAGE].  {S} I gain 1 boost.  '),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
