<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_ALTOzma extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_11_R1',
      'asset' => 'ALT_CORE_B_OR_11_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('ALT Ozma'),
      'type' => CHARACTER,
      'subtype' => CITIZEN,
      'effectDesc' => clienttranslate('{J} If you have at least 3 other Characters in your Expeditions, draw a card.'),
      'supportDesc' => clienttranslate(
        '#{D} : The next Character you play this turn costs {1} less.# (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'water'],

      'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'control3OtherCharacters',
        'effect' => FT::ACTION(DRAW, ['players' => ME]),
      ]),
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => CHARACTER, 'reduction' => 1]],
      ],
    ];
  }
}
