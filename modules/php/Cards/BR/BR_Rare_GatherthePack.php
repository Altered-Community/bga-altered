<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_GatherthePack extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_122_R2',
            'asset'  => 'ALT_EOLE_B_MU_122_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Gather the Pack"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Fahmi Fauzi",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Target Character with Base Cost {3} or less gains <ANCHORED>.  When you pass — If three or more #Characters# in your Expeditions have a different Base Cost, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: #All Characters# in your Expeditions are <TOUGH_CHA_P_1>.'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
