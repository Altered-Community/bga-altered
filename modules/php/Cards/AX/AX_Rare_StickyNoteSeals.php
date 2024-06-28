<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_StickyNoteSeals extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_25_R2',
      'asset' => 'ALT_CORE_B_OR_25_R',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Sticky Note Seals',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'Some lessons stick better than others.',
      'artist' => 'Atanas Lozanski',
      'subtypes' => [DISRUPTION],
      'effectDesc' =>
      '$<FLEETING>.  Choose one:  • Send to Reserve target Character with Hand Cost {4} or more.  • Discard target Permanent with Hand Cost {4} or more.',
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
    ];
  }
}
