<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_CarmelaFastStriker extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_111_R2',
            'asset'  => 'ALT_EOLE_B_BR_111_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Carmela, Fast Striker"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
			'extension'=>'ROC',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('#{J}# If you control a #<COMPLETED_LOW># Feat, #I lose <FLEETING>.#'),
 				'supportDesc' => clienttranslate('#{D} : Pay {1} less for the next Feat you play this turn, down to a minimum of {1}.#'),
 			     'supportIcon' => 'discard',
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
