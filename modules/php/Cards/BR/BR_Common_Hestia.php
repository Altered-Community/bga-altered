<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_Hestia extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_55_C',
            'asset'  => 'ALT_BISE_B_BR_55_C',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Hestia"),
            'typeline' => clienttranslate("Character - Deity"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('One offering for one serving of stew. House rules.'),
            'artist' => "Nestor Papatriantafyllou",
			'extension'=>'WFTM',
   'subtypes'  => [DEITY],
 				'supportDesc' => clienttranslate('{I} When you play another Character — You may pay {1} to give it 1 boost.'),
 			     'supportIcon' => 'infinity',
     'forest' => 4, 
     'mountain' => 2, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
