<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Ozma extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_11_R1',
      'asset' => 'ALT_CORE_B_OR_11_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Ozma',
      'type' => CHARACTER,
      'subtypes' => [NOBLE],
      'effectDesc' => '{J} If you control three or more other Characters, draw a card. (Cards in Reserve are not controlled.)',
      'supportDesc' => clienttranslate(
        '#{D} : The next Character you play this turn costs {1} less.# (Discard me from your Reserve to activate this effect)'
      ),
      'supportIcon' => 'discard',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'ocean'],

      'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'control3OtherCharacters',
        'effect' => FT::ACTION(DRAW, ['players' => ME]),
      ]),
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => CHARACTER, 'reduction' => 1]],
      ],
      'typeline' => 'Character - Noble',
      'flavorText' => "\"Never give up. No one knows what’s going to happen next.\"",
      'artist' => 'Taras Susak',
    ];
  }
}
