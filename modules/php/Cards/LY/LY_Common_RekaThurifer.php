<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_RekaThurifer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_116_C',
            'asset'  => 'ALT_EOLE_B_LY_116_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Reka Thurifer"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "DOBA",
			'extension'=>'ROC',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('{H} $<SABOTAGE>.'),
 				'supportDesc' => clienttranslate('{D} : Pay {1} less for the next Character you play this turn, down to a minimum of {1}. (Discard me from Reserve to do this.)'),
 			     'supportIcon' => 'discard',
     'forest' => 4, 
     'mountain' => 0, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 3, 
];
  }
}
