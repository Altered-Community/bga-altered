<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_HextagChaser extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_87_R2',
      'asset'  => 'ALT_DUSTER_B_YZ_87_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Hextag Chaser"),
      'typeline' => clienttranslate("Character - Rogue"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The element of surprise adds extra spice to any tactic.'),
      'artist' => "Damian Audino",
      'extension' => 'SDU',
      'subtypes'  => [ROGUE],
      'effectDesc' => clienttranslate('{H} You may exhaust ({T}) target card in Reserve. If #it\'s in your Reserve,# <RESUPPLY_LOW>.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(
        TARGET,
        [
          'targetLocation' => [RESERVE],
          'targetType' => [SPELL, CHARACTER, LANDMARK],
          'isNotTapped' => true,
          'upTo' => true,
          'effect' => FT::SEQ(
            FT::ACTION(EXHAUST, []),
            FT::ACTION(CHECK_CONDITION, ['condition' => 'isTargetSameOwner', 'effect' => FT::ACTION(RESUPPLY, [])])
          )
        ]
      )
    ];
  }
}
