<?php

namespace ALT\Cards\BR;

class BR_Common_BravosVanguard extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_14_C',
      'asset' => 'ALT_CORE_B_BR_14_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Bravos Vanguard'),
      'type' => CHARACTER,
      'subtype' => ADVENTURER,
      'effectDesc' => clienttranslate('{J} Another target Character loses $[FLEETING_CHAR].  '),
      'forest' => 4,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
