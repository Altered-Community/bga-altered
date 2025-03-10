<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_Icarus extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_56_R2',
            'asset'  => 'ALT_BISE_B_AX_56_R',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Icarus"),
            'typeline' => clienttranslate("Character - Adventurer"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('This time, I hope the Sap wax will hold.'),
            'artist' => "Atanas Lozanski",
			'extension'=>'WFTM',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('$<SCOUT_1> {1}.  {J} Ready all cards in your Reserve.'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 2, 
     'costHand' => 4, 
     'costReserve' => 3, 
 		'scout' => 99,
];
  }
}
