<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_TheReunion extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_101_C',
            'asset'  => 'ALT_DUSTER_B_OR_101_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("The Reunion"),
      'typeline' => clienttranslate("Landmark_permanent - Construction"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('"Two people separated by fate, now reunited once more! This reunion shall forever be carved in stone!"'),
      'artist' => "Kevin Sidharta",
			'extension'=>'SDU',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('{T} : Choose up to the number of cards in your Landmarks:  • Create an <ORDIS_RECRUIT> Soldier token in a Companion Expedition.  • Create an <ORDIS_RECRUIT> in a Hero Expedition.  • Up to two target Characters gain 1 boost.'),
     'costHand' => 6, 
     'costReserve' => 6, 
];
  }
}
