<?php

namespace ALT\Cards\AX;

class AX_Common_Frankenstein extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_17_C',
      'asset' => 'ALT_CORE_B_AX_17_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Frankenstein'),
      'type' => CHARACTER,
      'subtype' => ENGINEER,
      'effectDesc' => clienttranslate('{S} You may activate the {J} effect of one of your Permanents.  '),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
