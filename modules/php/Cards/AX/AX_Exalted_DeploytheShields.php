<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Exalted_DeploytheShields extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_120_E',
            'asset'  => 'ALT_EOLE_B_AX_120_E',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_EXALTED,
    	'name'  => clienttranslate("Deploy the Shields!"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung & Ba Vo",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} If there are no tokens in your Landmarks, create an <AEROLITH> token there.  When you pass — If three cards or more are in your Landmarks, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: When you sacrifice a Permanent — Target non-<BOOSTED> Character in your Reserve gains 1 boost.'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
