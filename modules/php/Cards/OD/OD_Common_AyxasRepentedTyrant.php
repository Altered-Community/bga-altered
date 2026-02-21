<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_AyxasRepentedTyrant extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_109_C',
            'asset'  => 'ALT_EOLE_B_OR_109_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Ayxas, Repented Tyrant"),
      'typeline' => clienttranslate("Character - Noble Rogue"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Tristan Bideau",
			'extension'=>'ROC',
   'subtypes'  => [NOBLE,ROGUE],
 				'effectDesc' => clienttranslate('{H} You may create an <ORDIS_RECRUIT> Soldier token in an opponent\'s Expedition to <SABOTAGE_LOW>.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
