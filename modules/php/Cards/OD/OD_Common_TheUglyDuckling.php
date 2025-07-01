<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_TheUglyDuckling extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_66_C',
            'asset'  => 'ALT_CYCLONE_B_OR_66_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("The Ugly Duckling"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('This young recruit swans about while proudly showing off his insignia.'),
      'artist' => "Kevin Sidharta",
			'extension'=>'SO',
   'subtypes'  => [ANIMAL],
 				'supportDesc' => clienttranslate('{D} : Target Expedition <ASCENDS>. (Until Rest, it can move forward even if matched in its region\'s terrains by the opponent\'s Expedition.)'),
 			     'supportIcon' => 'discard',
     'forest' => 1, 
     'mountain' => 0, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
