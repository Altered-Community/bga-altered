<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_BeautySleep extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_28_C',
      'asset' => 'ALT_CORE_B_MU_28_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Beauty Sleep'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        'Target Character gains <ASLEEP>. (During Dusk, ignore its statistics. During Rest, it doesn\'t go to Reserve and it loses Asleep.)'
      ),
      'effectPlayed' => FT::ACTION(TARGET, ['excludedStatuses' => [ASLEEP], 'effect' => FT::GAIN(EFFECT, ASLEEP)]),
      'flavorText' => clienttranslate('Yet beware of splinters of flax.'),
      'artist' => 'HuoMiao Studio',

      'costHand' => 1,
      'costReserve' => 3,
    ];
  }
}
