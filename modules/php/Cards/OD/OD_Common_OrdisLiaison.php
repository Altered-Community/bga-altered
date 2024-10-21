<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisLiaison extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_41_C',
            'asset'  => 'ALT_ALIZE_B_OR_41_C',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Ordis Liaison"),
            'typeline' => clienttranslate("Character - Messenger Soldier"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('"How may I help you?"'),
            'artist' => "Taras Susak",
			'extension'=>'TBF',
   'subtypes'  => [MESSENGER,SOLDIER],
 				'effectDesc' => clienttranslate('{J} Each other Character you control gains 1 boost.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
