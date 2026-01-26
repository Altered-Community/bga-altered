<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_AngryCrowd extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_99_R2',
      'asset'  => 'ALT_DUSTER_B_OR_99_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Angry Crowd"),
      'typeline' => clienttranslate("Spell - Disruption Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Anger is often the fruit of frustration.'),
      'artist' => "Justice Wong",
      'extension' => 'SDU',
      'subtypes'  => [DISRUPTION, MANEUVER],
      'effectDesc' => clienttranslate('<FLEETING>.  Discard target Character or Permanent. #If its Base Cost was {2} or less,# create a <MANASEED> token in your Landmarks. (Its Base Cost is the Reserve Cost if it\'s Fleeting. Otherwise, it\'s the Hand Cost.)'),
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::XOR(
          FT::SEQ(
            FT::ACTION(TARGET, [
              'targetType' => [CHARACTER, PERMANENT],
              'maxBaseCost' => 2,
              'effect' => FT::ACTION(DISCARD, [])
            ]),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'tokenType' => 'NE_Common_Manaseed',
              'targetLocation' => [LANDMARK],
            ])
          ),
          FT::ACTION(TARGET, [
            'targetType' => [CHARACTER, PERMANENT],
            'minBaseCost' => 3,
            'effect' => FT::ACTION(DISCARD, [])
          ]),
        )
      )
    ];
  }
}
