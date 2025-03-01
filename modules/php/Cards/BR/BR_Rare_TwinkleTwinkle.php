<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_TwinkleTwinkle extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_23_R2',
      'asset' => 'ALT_CORE_B_LY_23_R',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Twinkle Twinkle'),
      'typeline' => clienttranslate('Spell - Song'),
      'type' => SPELL,
      'flavorText' => clienttranslate('Up above the world so high, like a diamond in the sky.'),
      'artist' => 'HuoMiao Studio',
      'subtypes' => [SONG],
      'effectDesc' => clienttranslate(
        'Target Character gains <ASLEEP>. (During Dusk, ignore its statistics. During Rest, it doesn\'t go to Reserve and it loses Asleep.)'
      ),
      'supportDesc' => clienttranslate(
        '{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
      'supportIcon' => 'discard',
      'effectPlayed' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, ASLEEP)]),
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => ALL, 'reduction' => 1]],
      ],
    ];
  }
}
