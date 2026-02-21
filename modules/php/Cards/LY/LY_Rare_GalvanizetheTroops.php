<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_GalvanizetheTroops extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_120_R2',
            'asset'  => 'ALT_EOLE_B_BR_120_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Galvanize the Troops"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} <RESUPPLY>. Then, you may have target Character you control gain <FLEETING>.  When you pass — If you control two or more <FLEETING> Characters, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: At Noon — If you are first player, <RESUPPLY_LOW>. #Otherwise, target Character in your Reserve gains 1 boost.#'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
