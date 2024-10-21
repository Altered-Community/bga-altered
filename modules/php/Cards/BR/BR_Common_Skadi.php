<?php
namespace ALT\Cards\BR;

class BR_Common_Skadi extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_33_C',
            'asset'  => 'ALT_ALIZE_B_BR_33_C',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Skadi"),
            'typeline' => clienttranslate("Character - Deity"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Life is a slope. It\'s slow going up, and quick going down.'),
            'artist' => "Edward Chee & Seok Yeong",
			'extension'=>'TBF',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('{R} You may exhaust ({T}) target card in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 3, 
];
  }
}
