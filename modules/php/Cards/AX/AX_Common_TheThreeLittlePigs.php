<?php

namespace ALT\Cards\AX;

class AX_Common_TheThreeLittlePigs extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_12_C',
      'asset' => 'ALT_CORE_B_AX_12_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('The Three Little Pigs'),
      'type' => CHARACTER,
      'subtype' => [ENGINEER],
      'effectDesc' => clienttranslate('{J} If you have at least 2 cards in your Landmarks, I gain 1 boost.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
