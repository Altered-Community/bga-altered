<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_DelaytheCollapse extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_119_C',
            'asset'  => 'ALT_EOLE_B_OR_119_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Delay the Collapse"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Saeed Jalabi",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} <RESUPPLY>.  When you pass — If the total Hand Cost of cards in your Landmarks is {6} or more, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: Other cards in your Landmarks are <TOUGH_PER_P_1>. (Opponents must pay {1} to target them.)'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
