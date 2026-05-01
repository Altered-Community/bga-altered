<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_SeekerOwl extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_113_C',
            'asset'  => 'ALT_EOLE_B_OR_113_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Seeker Owl"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Kevin Sidharta",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('When I leave the Expedition zone — My Expedition <ASCENDS>. (If I leave at Rest, it stays Ascended for the next Day.)'),
     'forest' => 3, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
