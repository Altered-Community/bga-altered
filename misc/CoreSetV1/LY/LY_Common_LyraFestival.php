<?php

namespace ALT\Cards\LY;

class LY_Common_LyraFestival extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_29_C',
      'asset' => 'ALT_CORE_B_LY_29_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Lyra Festival'),
      'type' => PERMANENT,
      'subtype' => LANDMARK,
      'effectDesc' => clienttranslate(
        '{J} Draw a card.  At Dusk — If you have a [FLEETING] Character, another [ANCHORED] Character and another [ASLEEP] Character in your Expeditions, you win the game.'
      ),
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
