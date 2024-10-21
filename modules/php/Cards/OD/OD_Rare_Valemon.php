<?php
namespace ALT\Cards\OD;

class OD_Rare_Valemon extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_39_R1',
            'asset'  => 'ALT_ALIZE_B_OR_39_R',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Valemon"),
            'typeline' => clienttranslate("Character - Animal Noble"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Promise me to wait, and I will show you my real face.'),
            'artist' => "Matteo Spirito",
			'extension'=>'TBF',
   'subtypes'  => [ANIMAL,NOBLE],
 				'effectDesc' => clienttranslate('Unless you have eight or more Mana Orbs, I am $<DEFENDER>.  #If you have ten or more Mana Orbs, I am $<GIGANTIC>.#'),
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 4, 
     'costReserve' => 4, 
     'changedStats' => ['forest','mountain','ocean'], 
];
  }
}
