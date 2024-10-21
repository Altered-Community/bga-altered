<?php
namespace ALT\Cards\YZ;

class YZ_Rare_TheNilamWitheredTree extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_45_R1',
            'asset'  => 'ALT_ALIZE_B_YZ_45_R',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("The Nilam, Withered Tree"),
            'typeline' => clienttranslate("Landmark_permanent - Site"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Long after it died, the Nilam still held life as the nesting grounds for the Mana Moths.'),
            'artist' => "Khoa Viet",
			'extension'=>'TBF',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('When you exhaust a card in Reserve — You may exhaust me ({T}) to create a <MANA_MOTH> Illusion token in target Expedition.'),
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
