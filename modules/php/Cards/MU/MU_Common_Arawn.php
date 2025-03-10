<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_Arawn extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_57_C',
            'asset'  => 'ALT_BISE_B_MU_57_C',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Arawn"),
            'typeline' => clienttranslate("Character - Spirit"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('The Wild Hunt comes to free the restless spirits.'),
            'artist' => "Taras Susak",
			'extension'=>'WFTM',
   'subtypes'  => [SPIRIT],
 				'effectDesc' => clienttranslate('$<SCOUT_2> {2}.  {J} Animals you control gain 1 boost.'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 6, 
     'costHand' => 5, 
     'costReserve' => 5, 
 		'scout' => 99,
];
  }
}
