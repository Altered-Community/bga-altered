<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_Hippogriff extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_112_R1',
            'asset'  => 'ALT_EOLE_B_OR_112_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Hippogriff"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Khoa Viet",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('#{J}# My Expedition <ASCENDS>.  When my Expedition #moves forward <DUE_TO_ASCENSION># — Create an <ORDIS_RECRUIT> Soldier token in that Expedition after Rest.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['forest','mountain'], 
];
  }
}
