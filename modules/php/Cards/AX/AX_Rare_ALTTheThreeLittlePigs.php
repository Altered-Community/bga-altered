<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_ALTTheThreeLittlePigs extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_12_R1',
      'asset' => 'ALT_CORE_B_AX_12_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('ALT The Three Little Pigs'),
      'type' => CHARACTER,
      'subtype' => [ENGINEER],
      'effectDesc' => clienttranslate('{J} If you have at least 2 cards in your Landmarks, I gain #2# boosts.'),
      'supportDesc' => clienttranslate(
        '#{D} : The next Permanent you play this turn costs {1} less.# (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'control2Landmarks',
        'effect' => FT::GAIN(ME, BOOST, 2),
      ]),
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 1]],
      ],
    ];
  }
}
