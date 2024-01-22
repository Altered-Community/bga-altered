<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_PaintPrison extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_26_C',
      'asset' => 'ALT_CORE_B_LY_26_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Paint Prison'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '$[FLEETING].  You may discard a card from your Reserve to reduce my cost by {2}.  Return target Character or Permanent to the top of its owner\'s deck.'
      ),
      'costHand' => 3,
      'costReserve' => 5,
      'costReductionDiscard' => 2,
      'effectPlayed' => FT::ACTION(
        TARGET,
        [
          'targetType' => [CHARACTER, TOKEN, PERMANENT],
          'effect' => FT::ACTION(DISCARD, ['destination' => 'topOfDeck'])
        ]
      )
    ];
  }
}
