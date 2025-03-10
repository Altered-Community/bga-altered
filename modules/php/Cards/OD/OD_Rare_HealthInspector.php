<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_HealthInspector extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_55_R1',
            'asset'  => 'ALT_BISE_B_OR_55_R',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Health Inspector"),
            'typeline' => clienttranslate("Character - Bureaucrat"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Using untested ingredients is a recipe for disaster.'),
            'artist' => "Justice Wong",
			'extension'=>'WFTM',
   'subtypes'  => [BUREAUCRAT],
 				'effectDesc' => clienttranslate('#Cards in play or in Reserve with counters# can\'t gain counters. (This doesn\'t affect Hero cards.)'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 4, 
     'costReserve' => 4, 
     'changedStats' => ['forest','mountain','ocean'], 
];
  }
}
