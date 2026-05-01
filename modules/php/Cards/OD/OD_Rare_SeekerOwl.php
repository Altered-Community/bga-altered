<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_SeekerOwl extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_113_R1',
            'asset'  => 'ALT_EOLE_B_OR_113_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Seeker Owl"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Kevin Sidharta",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('When I leave the Expedition zone — #Each of your Expeditions# <ASCENDS>.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['mountain'], 
];
  }
}
