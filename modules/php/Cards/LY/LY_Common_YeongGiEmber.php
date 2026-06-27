<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_YeongGiEmber extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_LY_105_C',
      'asset' => 'ALT_EOLE_B_LY_105_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Yeong-Gi & Ember'),
      'type' => HERO,
      'thumbnail' => 4,
      'statData' => 28,
      'typeline' => clienttranslate('Lyra Hero'),
      'effectDesc' => clienttranslate(
        '{T} : Roll a die, then spend any number of my Luck counters to increase the result by that much. On a:  • 4+, You may target a Character in your Expeditions. It activates its {D} ability.  • 1-3: I gain a Luck counter.'
      ),
      			'flavorText'  => clienttranslate('"Allow me to enlighten you…"'),
			'artist' => 'Zero Wen',

      'reserveSlots' => 2,
      'landmarkSlots' => 2,

      'effectTap' => FT::ACTION(ROLL_DIE, [
        'allowCounterIncrease' => true,
        'effect' => [
          '4+' => FT::ACTION(TARGET, [
              'desc' => clienttranslate('Target a card for Yeong-Gi & Ember effect'),
              'targetType' => [CHARACTER],
              'targetLocation' => [STORM_LEFT, STORM_RIGHT],
              'targetPlayer' => ME,
              'hasEffects' => ['Support'],
              'effect' => FT::ACTION(ACTIVATE_EFFECT, ['effectType' => 'Support', 'n' => 1, 'ownEffect' => false]),
          ]),
          '1-3' => FT::ACTION(SPECIAL_EFFECT, [
              'effect' => 'incCounter',
              'args' => ['counter' => 1, 'counterName' => clienttranslate('Luck counter')],
          ]),
        ],
      ]),
    ];
  }
}
