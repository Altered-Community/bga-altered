<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_Finisher extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_98_C',
      'asset'  => 'ALT_DUSTER_B_YZ_98_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Finisher"),
      'typeline' => clienttranslate("Spell - Disruption Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"Maaaaaleros!"'),
      'artist' => "DOBA",
      'extension' => 'SDU',
      'subtypes'  => [DISRUPTION, MANEUVER],
      'effectDesc' => clienttranslate('<FLEETING>.  Choose up to three:  • Discard target Character.  • Discard target Permanent.  • <SABOTAGE>.'),
      'costHand' => 7,
      'costReserve' => 7,
      'effecPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        [
          'type' => NODE_OR,
          'args' => ['n' => 3],
          'pId' => 'source',
          'option' => true,
          'childs' => [
            FT::SABOTAGE(),
            FT::ACTION(TARGET, ['effect' => FT::ACTION(DISCARD, [])]),
            FT::ACTION(TARGET, ['targetType' => [CHARACTER, PERMANENT], 'effect' => FT::ACTION(DISCARD, [])]),
          ]
        ]
      )
    ];
  }
}
