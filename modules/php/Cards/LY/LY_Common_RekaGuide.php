<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_RekaGuide extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_87_C',
            'asset'  => 'ALT_DUSTER_B_LY_87_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Reka Guide"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Let\'s wrap up today\'s visit with a taste of some local specialties."'),
      'artist' => "DOBA",
			'extension'=>'SDU',
   'subtypes'  => [CITIZEN],
 				'supportDesc' => clienttranslate('{D} : Return another Character from your Reserve to your hand. (Discard me from Reserve to do this.)'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
