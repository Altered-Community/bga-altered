<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_SmokingSkunk extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_106_C',
            'asset'  => 'ALT_EOLE_B_LY_106_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Smoking Skunk"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Kevin Sidharta",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'supportDesc' => clienttranslate('{D} : Pay {1} less for the next Character you play this turn, down to a minimum of {1}. (Discard me from Reserve to do this.)'),
 			     'supportIcon' => 'discard',
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
