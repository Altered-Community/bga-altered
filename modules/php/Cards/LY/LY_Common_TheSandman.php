<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_TheSandman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_15_C',
      'asset' => 'ALT_CORE_B_LY_15_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => 'The Sandman',
      'typeline' => 'Character - Artist',
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'effectDesc' => clienttranslate('{H} Up to one target Character gains $[ASLEEP].'),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,

      'effectHand' => FT::ACTION(TARGET, ['upTo' => true, 'effect' => FT::GAIN(EFFECT, ASLEEP)]),
      'artist' => 'Nestor Papatriantafyllou',
    ];
  }
}
