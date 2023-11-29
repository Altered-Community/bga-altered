<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_KelonSurge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_23_C',
      'asset' => 'ALT_CORE_B_AX_23_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kelon Surge'),
      'type' => SPELL,
      'subtype' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '$[FLEETING].  Choose one:  - Send to Reserve target Character of hand cost {4} or less.  - Discard target Permanent of hand cost {4} or less.'
      ),
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
