<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_GalvanizetheTroops extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_120_C',
            'asset'  => 'ALT_EOLE_B_BR_120_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Galvanize the Troops"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} <RESUPPLY>. Then, you may have target Character you control gain <FLEETING>.  When you pass — If you control two or more <FLEETING> Characters, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: At Noon — If you are first player, <RESUPPLY_LOW>.'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
