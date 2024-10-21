<?php
namespace ALT\Cards\MU;

class MU_Rare_MagicBeans extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_43_R1',
            'asset'  => 'ALT_ALIZE_B_MU_43_R',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Magic Beans"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Come on, spill the beans!'),
            'artist' => "Gael Giudicelli",
			'extension'=>'TBF',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('{J} Target Character in my Expedition gains 1 boost.  My region #and the region of the Expedition facing me# are {V} #and lose their other types.#'),
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
