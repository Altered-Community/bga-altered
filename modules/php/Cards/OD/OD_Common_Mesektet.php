<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_Mesektet extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_62_C',
            'asset'  => 'ALT_BISE_B_OR_62_C',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Mesektet"),
            'typeline' => clienttranslate("Landmark_permanent - Construction"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Repaired by the Axiom, the pride of the Aegis takes flight once again.'),
            'artist' => "Taras Susak",
			'extension'=>'WFTM',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('At Noon — Create an <ORDIS_RECRUIT> Soldier token in each of your Expeditions that\'s behind or tied.'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
