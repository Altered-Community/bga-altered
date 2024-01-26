<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_MeditationTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_25_C',
      'asset' => 'ALT_CORE_B_MU_25_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Meditation Training'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate(
        'Target Character with Hand Cost {3} or less gains [ANCHORED]. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)'
      ),
      'typeline' => clienttranslate('Spell - Boon'),
      'flavorText' => clienttranslate("Don't think you are, know you are."),
      'artist' => 'HuoMiao Studio',

      'costHand' => 2,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN($this, ANCHORED)]),
    ];
  }
}
