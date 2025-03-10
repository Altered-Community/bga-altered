<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_TalarianSkater extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_52_C',
            'asset'  => 'ALT_BISE_B_BR_52_C',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Talarian Skater"),
            'typeline' => clienttranslate("Character - Messenger"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('To explore the City, adventurers need daily deliveries from the surface.'),
            'artist' => "Exia",
			'extension'=>'WFTM',
   'subtypes'  => [MESSENGER],
 				'effectDesc' => clienttranslate('$<SCOUT_1> {1}.  {J} Target Character gains 1 boost.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 3, 
 		'scout' => 99,
];
  }
}
