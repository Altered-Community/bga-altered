<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_GatherthePack extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_122_C',
            'asset'  => 'ALT_EOLE_B_MU_122_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Gather the Pack"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Fahmi Fauzi",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Target Character with Base Cost {3} or less gains <ANCHORED>. (Its Base Cost is the Reserve Cost if Fleeting, or the Hand Cost if not.)  When you pass — If three or more Animals in your Expeditions have a different Base Cost, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: <ANCHORED_CHA_P> Characters in your Expeditions are <TOUGH_CHA_P_1>. (Opponents must pay {1} to target them.)'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
