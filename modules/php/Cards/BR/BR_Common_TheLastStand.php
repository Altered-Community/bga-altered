<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_TheLastStand extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_118_C',
      'asset'  => 'ALT_EOLE_B_BR_118_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("The Last Stand"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('"If we are to fall, let this be our last stand!"'),
      'artist' => "Taras Susak",
      'extension' => 'ROC',
      'subtypes'  => [FEAT, LANDMARK],
      'effectDesc' => clienttranslate('{J} Send to Reserve target Character with Base Cost {3} or less.  When you pass — If you control another Feat, complete me.'),
      'supportDesc' => clienttranslate('<COMPLETED>: Your Landmarks limit is four.'),
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(TARGET, [
        'maxBaseCost' => 3,
        'upTo' => true,
        'effect' => FT::DISCARD_TO_RESERVE(),
      ]),
      'effectPassive' => [
        // Pass uses checkAfterListeners(..., 'EndTurn'); ChooseAssignment passives never see that event.
        'EndTurn' => [
          'conditions' => ['isMe', 'hasControlFeat:1:true', 'isThisFeatIncomplete'],
          'output' => FT::ACTION(COMPLETE_FEAT, ['cardId' => 'source']),
        ],
      ],
      // Applied while this Feat has a completed marker (see Player::getLandmarkSlots()).
      'effectCompleted' => [
        'landmarkSlots' => 4,
      ],
    ];
  }
}
