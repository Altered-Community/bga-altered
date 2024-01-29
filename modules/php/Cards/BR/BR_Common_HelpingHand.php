<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_HelpingHand extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_25_C',
      'asset' => 'ALT_CORE_B_BR_25_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => 'Helping Hand',
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => 'Target Character gains 1 boost$<BB> and loses <FLEETING_CHAR>.',
      'typeline' => 'Spell - Boon',
      'flavorText' => 'Never gonna give you up.',
      'artist' => 'Edward Cheekokseang',

      'costHand' => 1,
      'costReserve' => 2,

      'effectPlayed' => FT::ACTION(TARGET, [
        'effect' => FT::SEQ(FT::GAIN(EFFECT, BOOST), FT::LOOSE(EFFECT, FLEETING)),
      ]),
    ];
  }
}
