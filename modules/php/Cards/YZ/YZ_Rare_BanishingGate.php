<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_BanishingGate extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_24_R1',
      'asset' => 'ALT_CORE_B_YZ_24_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Banishing Gate',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => 'Discard target Character or Permanent.',
      'costHand' => 4,
      'costReserve' => 5,
      'changedStats' => ['costReserve'],
      'effectPlayed' => FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN, PERMANENT], 'effect' => FT::ACTION(DISCARD, [])]),

      'flavorText' => 'Let me walk you to the door.',
      'artist' => 'MISSING ARTIST',
    ];
  }
}
