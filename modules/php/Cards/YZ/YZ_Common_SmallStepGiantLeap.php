<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_SmallStepGiantLeap extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_25_C',
      'asset' => 'ALT_CORE_B_YZ_25_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Small Step, Giant Leap'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'flavorText' => clienttranslate('The journey of a thousand miles begins with one step.'),
      'artist' => 'HuoMiao Studio',
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate('$<FLEETING>.  Target Expedition moves forward one region.'),
      'costHand' => 6,
      'costReserve' => 6,
      'effectPlayed' => FT::SEQ(FT::GAIN($this, FLEETING), FT::ACTION(MOVE_EXPEDITION, [])),
    ];
  }
}
