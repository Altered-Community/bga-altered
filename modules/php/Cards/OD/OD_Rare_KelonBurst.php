<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;


class OD_Rare_KelonBurst extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_23_R2',
      'asset' => 'ALT_CORE_B_AX_23_R',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Kelon Burst',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'There\'s an enduring legend in the Suspira quarries: the existence of another type of Kelon.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [DISRUPTION],
      'effectDesc' =>
      '$<FLEETING>.  Choose one:  • Send to Reserve target Character with Hand Cost {4} or less.  • Discard target Permanent with Hand Cost {4} or less.',
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
