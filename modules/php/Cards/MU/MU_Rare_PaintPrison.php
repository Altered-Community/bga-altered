<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_PaintPrison extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_26_R2',
      'asset' => 'ALT_CORE_B_LY_26_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Paint Prison',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'Your problem is a lack of perspective.',
      'artist' => 'Justice Wong',
      'subtypes' => [DISRUPTION],
      'effectDesc' =>
      '$<FLEETING>.  You may discard a card from your Reserve to reduce my cost by {2}.  Return target Character or Permanent to the top of its owner\'s deck.',
      'costHand' => 5,
      'costReserve' => 5,
      'costReductionDiscard' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, TOKEN, PERMANENT],
          'effect' => FT::ACTION(DISCARD, ['destination' => 'topOfDeck']),
        ])
      ),
    ];
  }
}
