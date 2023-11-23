<?php

namespace ALT\Cards\LY;

class LY_Common_TwinkleTwinkle extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_23_C',
      'asset' => 'ALT_CORE_B_LY_23_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Twinkle Twinkle'),
      'type' => SPELL,
      'subtype' => SONG,
      'effectDesc' => clienttranslate('Target Character becomes $[ASLEEP].  '),
      'supportDesc' => clienttranslate(
        '{D} : The next card you play this turn costs {1} less. (Discard me from your Reserve to activate this effect)  '
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
