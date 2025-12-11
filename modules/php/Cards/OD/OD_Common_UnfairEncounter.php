<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_UnfairEncounter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_98_C',
      'asset'  => 'ALT_DUSTER_B_OR_98_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Unfair Encounter"),
      'typeline' => clienttranslate("Spell - Disruption Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"Your goods are now Hexarch property."'),
      'artist' => "Fahmi Fauzi",
      'extension' => 'SDU',
      'subtypes'  => [DISRUPTION, MANEUVER],
      'effectDesc' => clienttranslate('<FLEETING>.  Take control of target Landmark Permanent with Hand Cost {2} or less. (It joins your Landmarks.)'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'targetPlayer' => OPPONENT,
          'targetLocation' => [LANDMARK],
          'targetType' => [PERMANENT],
          'maxHandCost' => 2,
          'effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'defect'])
        ])
      )
    ];
  }
}
