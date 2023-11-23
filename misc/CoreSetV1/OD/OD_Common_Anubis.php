<?php

namespace ALT\Cards\OD;

class OD_Common_Anubis extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_20_C',
      'asset' => 'ALT_CORE_B_OR_20_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Anubis'),
      'type' => CHARACTER,
      'subtype' => DIVINITY,
      'effectDesc' => clienttranslate('{J} Each player sacrifices a Character.  '),
      'forest' => 3,
      'mountain' => 4,
      'ocean' => 3,
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
