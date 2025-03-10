<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_BravosExcavator extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_53_C',
            'asset'  => 'ALT_BISE_B_BR_53_C',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Bravos Excavator"),
            'typeline' => clienttranslate("Character - Citizen"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('The depths of the city are filled with archaeological marvels... along with plenty of Sap!'),
            'artist' => "Ed Chee, S.Yong & Stephen",
			'extension'=>'WFTM',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('When I leave the Expedition zone, for each of my boosts — Another target Character in your Reserve gains 1 boost.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
