<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Finisher extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_98_R2',
      'asset'  => 'ALT_DUSTER_B_YZ_98_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Finisher"),
      'typeline' => clienttranslate("Spell - Disruption Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"Maaaaaleros!"'),
      'artist' => "DOBA",
      'extension' => 'SDU',
      'subtypes'  => [DISRUPTION, MANEUVER],
      'effectDesc' => clienttranslate('<FLEETING>.  Choose up to three, #you may choose the same option multiple times:#  • Discard target Character.  • Discard target Permanent.  • <SABOTAGE>.'),
      'costHand' => 7,
      'costReserve' => 7,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        [
          'type' => NODE_OR,
          'args' => ['n' => 3, 'canReuse' => true],
          'pId' => 'source',
          'option' => true,
          'childs' => [
            FT::SABOTAGE(),
            FT::ACTION(TARGET, ['targetType' => [CHARACTER], 'effect' => FT::ACTION(DISCARD, [])]),
            FT::ACTION(TARGET, ['targetType' => [PERMANENT], 'effect' => FT::ACTION(DISCARD, [])]),
          ]
        ]
      )
    ];
  }
}
