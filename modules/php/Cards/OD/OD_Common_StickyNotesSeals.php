<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_StickyNotesSeals extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_25_C',
      'asset' => 'ALT_CORE_B_OR_25_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Sticky Notes Seals'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '$[FLEETING].  Choose one:  - Send to Reserve target Character of hand cost {4} or more.  - Discard target Permanent of hand cost {4} or more.'
      ),
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::SEQ(FT::GAIN($this, FLEETING), [
        'optional' => true,
        'type' => NODE_XOR,
        'childs' => [
          FT::ACTION(TARGET, ['minHandCost' => 4, 'effect' => FT::DISCARD_TO_RESERVE()]),
          FT::ACTION(TARGET, ['minHandCost' => 4, 'targetType' => [PERMANENT], 'effect' => FT::ACTION(DISCARD, [])]),
        ],
      ]),
      'typeline' => clienttranslate('Spell - Disruption'),
    ];
  }
}
