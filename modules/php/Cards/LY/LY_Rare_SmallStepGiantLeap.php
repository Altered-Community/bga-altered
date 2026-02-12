<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_SmallStepGiantLeap extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_25_R2',
      'asset' => 'ALT_CORE_B_YZ_25_R',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Small Step, Giant Leap'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'flavorText' => clienttranslate('The journey of a thousand miles begins with one step.'),
      'artist' => 'HuoMiao Studio',
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate('$<FLEETING>.  Target Expedition moves forward one region.'),
      'costHand' => 6,
      'costReserve' => 6,
      'effectPlayed' => FT::SEQ(FT::GAIN(ME, FLEETING), FT::ACTION(MOVE_EXPEDITION, [])),
    ];
  }
}
