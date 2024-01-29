<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_AllIn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_25_C',
      'asset' => 'ALT_CORE_B_LY_25_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('All In!'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate('Roll a die. Target Character gains X boosts$<BB>, where X is the result.'),
      'typeline' => clienttranslate('Spell - Boon'),
      'flavorText' => clienttranslate('There\'s a time to be cautious, and a time to bet it all!'),
      'artist' => 'HuoMiao Studio',

      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(ROLL_DIE, [
        'effect' => ['1+' => FT::ACTION(TARGET, ['effect' => FT::GAIN('effect', BOOST, 'die')])],
      ]),
    ];
  }
}
