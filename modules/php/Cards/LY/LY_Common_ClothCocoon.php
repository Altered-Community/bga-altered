<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_ClothCocoon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_24_C',
      'asset' => 'ALT_CORE_B_LY_24_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => 'Cloth Cocoon',
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' =>
        '$[FLEETING].  Choose one:  • Discard target [FLEETING_CHAR], [ANCHORED] or [ASLEEP] Character.  • Discard target Permanent.',
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, [
          'statuses' => [FLEETING, ANCHORED, ASLEEP],
          'targetType' => [CHARACTER, TOKEN, PERMANENT],
          'effect' => FT::ACTION(DISCARD, []),
        ])
      ),
      'typeline' => 'Spell - Disruption',
      'flavorText' => 'Nobody expects... the cloth dancer!',
      'artist' => 'Zero Wen',
    ];
  }
}
