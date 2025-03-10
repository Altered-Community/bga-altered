<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_Icarus extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_56_R1',
            'asset'  => 'ALT_BISE_B_AX_56_R',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Icarus"),
            'typeline' => clienttranslate("Character - Adventurer"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('This time, I hope the Sap wax will hold.'),
            'artist' => "Atanas Lozanski",
			'extension'=>'WFTM',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('$<SCOUT_1> {1}. '),
 				'supportDesc' => clienttranslate('#{I} You may play exhausted cards from your Reserve.#'),
 			     'supportIcon' => 'infinity',
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 2, 
     'costHand' => 4, 
     'costReserve' => 3, 
 		'scout' => 99,
];
  }
}
