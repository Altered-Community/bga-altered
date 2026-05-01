<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_ProtecttheAssets extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_119_R2',
            'asset'  => 'ALT_EOLE_B_BR_119_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Protect the Assets"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Up to one target Character loses <FLEETING>.  At Noon — If there are two or more cards in your Reserve, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: Characters in your Reserve are <TOUGH_CHA_P_1>.'),
 			     'supportIcon' => 'discard',
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
