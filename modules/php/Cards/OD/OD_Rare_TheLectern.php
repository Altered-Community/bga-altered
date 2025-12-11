<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_TheLectern extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_100_R1',
      'asset'  => 'ALT_DUSTER_B_OR_100_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("The Lectern"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Sol may have sounded the alarm, but her words seem to be falling on deaf ears.'),
      'artist' => "Ba Vo",
      'extension' => 'SDU',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{J} #If there\'s another card in your Landmarks, draw a card.# Otherwise, <RESUPPLY_LOW>.  When I\'m sacrificed — Create an <ORDIS_RECRUIT> in a Hero Expedition.'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPassive' => [
        'Discard' => [
          'condition' => 'isSacrificed',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'allPlayers' => true,
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => [STORM_LEFT],
          ]),
        ]
      ],
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'hasControl:landmark:1:true', 'effect' => FT::ACTION(DRAW, ['players' => ME]), 'oppositeEffect' => FT::ACTION(RESUPPLY, [])])
    ];
  }
}
