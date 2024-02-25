<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_CelestialBlast extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_27_C',
      'asset' => 'ALT_CORE_B_YZ_27_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => 'Celestial Blast',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'The sky cracked open in a thunderous wave as the dream was unleashed upon the world.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [DISRUPTION],
      'effectDesc' => '$<FLEETING>.  Discard up to two targets, Characters or Permanents.',
      'costHand' => 7,
      'costReserve' => 7,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, TOKEN, PERMANENT],
          'n' => 2,
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ])
      )
    ];
  }
}
