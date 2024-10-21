<?php
namespace ALT\Cards\BR;

class BR_Common_ArcolanoMilk extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_43_C',
            'asset'  => 'ALT_ALIZE_B_BR_43_C',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Arcolano Milk"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Nobody knows where this "milk" actually comes from.'),
            'artist' => "Kevin Sidharta",
			'extension'=>'TBF',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('When a Character joins my Expedition — It gains 1 boost and <FLEETING_CHAR>. (If it would be sent to Reserve, discard it instead.)'),
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
