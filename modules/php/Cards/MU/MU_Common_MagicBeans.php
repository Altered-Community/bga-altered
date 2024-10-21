<?php
namespace ALT\Cards\MU;

class MU_Common_MagicBeans extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_43_C',
            'asset'  => 'ALT_ALIZE_B_MU_43_C',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Magic Beans"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Come on, spill the beans!'),
            'artist' => "Gael Giudicelli",
			'extension'=>'TBF',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('{J} Target Character in my Expedition gains 1 boost.  My region is {V} in addition to its other types.'),
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
