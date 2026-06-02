<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_DelaytheCollapse extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_OR_119_R2',
      'asset'  => 'ALT_EOLE_B_OR_119_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Delay the Collapse"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('"Hold out for as long as possible. That\'s all that matters."'),
      'artist' => "Saeed Jalabi",
			'extension'=>'ROC',
      'subtypes'  => [FEAT,LANDMARK],
      'effectDesc' => clienttranslate('{J} #Create an <AEROLITH> token in your Landmarks.#  When you pass — If the total Hand Cost of cards in your Landmarks is {6} or more, complete me.'),
      'supportDesc' => clienttranslate('<COMPLETED>: Other cards in your Landmarks are <TOUGH_CHA_P_1>.'),
      'costHand' => 2, 
      'costReserve' => 2, 
      'effectPlayed' => [
        'action' => INVOKE_TOKEN,
        'automatic' => true,
        'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]],
      ],
      'effectPassive' => [
        'EndTurn' => [
          'conditions' => ['isMe', 'has6HandCostLandmarks', 'isThisFeatIncomplete'],
          'output' => FT::ACTION(COMPLETE_FEAT, ['cardId' => 'source']),
        ],
      ],
      'effectCompleted' => [
        'dynamicTough' => 'universalLandmarks1',
      ],
    ];
  }
}
