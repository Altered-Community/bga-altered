<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_Hippogriff extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_112_C',
            'asset'  => 'ALT_EOLE_B_OR_112_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Hippogriff"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Khoa Viet",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} My Expedition <ASCENDS>.  When I leave an <ASCENDED_S> Expedition — Create an <ORDIS_RECRUIT> Soldier token in it.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
