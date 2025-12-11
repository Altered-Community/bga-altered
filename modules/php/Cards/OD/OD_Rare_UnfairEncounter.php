<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_UnfairEncounter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_98_R1',
      'asset'  => 'ALT_DUSTER_B_OR_98_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Unfair Encounter"),
      'typeline' => clienttranslate("Spell - Disruption Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"Your goods are now Hexarch property."'),
      'artist' => "Fahmi Fauzi",
      'extension' => 'SDU',
      'subtypes'  => [DISRUPTION, MANEUVER],
      'effectDesc' => clienttranslate('<FLEETING>.  Target a Landmark Permanent with Hand Cost {2} or less. #Its controller <RESUPPLIES>,# then you take control of it. (It joins your Landmarks.)'),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'targetPlayer' => OPPONENT,
          'targetLocation' => [LANDMARK],
          'targetType' => [PERMANENT],
          'maxHandCost' => 2,
          'effect' => FT::SEQ(
            FT::ACTION(RESUPPLY, ['player' => 'nextPlayer']),
            FT::ACTION(SPECIAL_EFFECT, ['effect' => 'defect'])
          )
        ])
      )
    ];
  }
}
