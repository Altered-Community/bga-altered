<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_KelonBurst extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_23_C',
      'asset' => 'ALT_CORE_B_AX_23_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kelon Burst'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '$<FLEETING>.  Choose one:  • Send to Reserve target Character with Hand Cost {4} or less.  • Discard target Permanent with Hand Cost {4} or less.'
      ),
      'typeline' => clienttranslate('Spell - Disruption'),
      'flavorText' => clienttranslate(
        'There\'s an enduring legend in the Suspira quarries: the existence of another type of Kelon.'
      ),
      'artist' => 'HuoMiao Studio',

      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::SEQ(FT::GAIN($this, FLEETING), [
        'optional' => true,
        'type' => NODE_XOR,
        'childs' => [
          FT::ACTION(TARGET, ['maxHandCost' => 4, 'effect' => FT::DISCARD_TO_RESERVE()]),
          FT::ACTION(TARGET, ['maxHandCost' => 4, 'targetType' => [PERMANENT], 'effect' => FT::ACTION(DISCARD, [])]),
        ],
      ]),
    ];
  }
}
