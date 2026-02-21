<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_DelaytheCollapse extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_119_R1',
            'asset'  => 'ALT_EOLE_B_OR_119_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Delay the Collapse"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Saeed Jalabi",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} #Create an <AEROLITH> token in your Landmarks.#  When you pass — If the total Hand Cost of cards in your Landmarks is {6} or more, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: Other cards in your Landmarks are <TOUGH_PER_P_1>.'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
