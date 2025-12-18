<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_MochizukiChiyome extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_92_R1',
      'asset'  => 'ALT_DUSTER_B_YZ_92_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Mochizuki Chiyome"),
      'typeline' => clienttranslate("Character - Rogue Soldier"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The art of surprise is showing up where you\'re not expected.'),
      'artist' => "Gamon Studio",
      'extension' => 'SDU',
      'subtypes'  => [ROGUE, SOLDIER],
      'effectDesc' => clienttranslate('#{J} If I\'m <IN_CONTACT>, pay {1} less for the next Spell you play this Afternoon, down to a minimum of {1}.# (I\'m In Contact if another player\'s Expedition is in my region. Other effects may reduce the cost further.)'),
      'supportDesc' => clienttranslate('{D} : Pay {1} less for the next Spell you play this turn, down to a minimum of {1}.'),
      'supportIcon' => 'discard',
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => SPELL, 'reduction' => 1, 'minimum' => 1, 'permanent' => false]],
      ],
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'isInContact',
        'effect' => [
          'action' => SPECIAL_EFFECT,
          'args' => ['effect' => 'costReduction', 'args' => ['type' => SPELL, 'reduction' => 1, 'minimum' => 1, 'permanent' => true]],
        ]
      ]),
    ];
  }
}
