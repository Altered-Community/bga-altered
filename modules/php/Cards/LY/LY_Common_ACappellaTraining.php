<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_ACappellaTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_22_C',
      'asset' => 'ALT_CORE_B_LY_22_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('A Cappella Training'),
      'type' => SPELL,
      'subtypes' => [SONG],
      'effectDesc' => clienttranslate(
        'Target Character gains <FLEETING_CHAR>. (If it would be sent to Reserve, discard it instead.)'
      ),
      'typeline' => clienttranslate('Spell - Song'),
      'flavorText' => clienttranslate('Thank you for being my metronome!'),
      'artist' => 'Zero Wen',

      'costHand' => 1,
      'costReserve' => 1,
      'effectPlayed' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, FLEETING)]),
    ];
  }
}
