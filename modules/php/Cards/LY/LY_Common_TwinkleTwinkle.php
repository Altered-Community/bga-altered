<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

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
      'typeline' => clienttranslate('Spell - Song'),
      'type' => SPELL,
      'subtypes' => [SONG],
      'effectDesc' => clienttranslate(
        'Target Character gains <ASLEEP>. (During Dusk, ignore its statistics. During Rest, it doesn\'t go to Reserve and it loses Asleep.)'
      ),
      'supportDesc' => clienttranslate(
        '{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'supportIcon' => 'discard',
      'flavorText' => clienttranslate('Up above the world so high, like a diamond in the sky.'),
      'artist' => 'HuoMiao Studio',

      'costHand' => 2,
      'costReserve' => 2,

      'effectPlayed' => FT::ACTION(TARGET, ['excludedStatuses' => [ASLEEP], 'effect' => FT::GAIN(EFFECT, ASLEEP)]),
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => ALL, 'reduction' => 1]],
      ],
    ];
  }
}
