<?php

namespace ALT\Cards\AX;

class AX_Common_FoundryArmorer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_16_C',
      'asset' => 'ALT_CORE_B_AX_16_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Foundry Armorer'),
      'type' => CHARACTER,
      'subtype' => ENGINEER,
      'effectDesc' => clienttranslate('{S} Create a [BRASSBUG] Robot token.  '),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
