<?php
namespace ALT\Cards\AX;

class AX_Rare_ArcolanoMilk extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_43_R2',
            'asset'  => 'ALT_ALIZE_B_BR_43_R2',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Arcolano Milk"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Nobody knows where this "milk" actually comes from.'),
            'artist' => "Kevin Sidharta",
			'extension'=>'TBF',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('When a Character joins my Expedition — It gains 1 boost and <FLEETING_CHAR>.'),
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
