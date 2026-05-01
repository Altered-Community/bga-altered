<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_ProtecttheAssets extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_119_C',
            'asset'  => 'ALT_EOLE_B_BR_119_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Protect the Assets"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Up to one target Character loses <FLEETING>.  At Noon — If there are two or more cards in your Reserve, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: Characters in your Reserve are <TOUGH_CHA_P_1>. (Opponents must pay {1} to target them.)'),
 			     'supportIcon' => 'discard',
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
