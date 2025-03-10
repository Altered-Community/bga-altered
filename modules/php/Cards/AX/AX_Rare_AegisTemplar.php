<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_AegisTemplar extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_54_R2',
            'asset'  => 'ALT_BISE_B_OR_54_R',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Aegis Templar"),
            'typeline' => clienttranslate("Character - Soldier"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('The Templars always ensure that the area is safe.'),
            'artist' => "Taras Susak",
			'extension'=>'WFTM',
   'subtypes'  => [SOLDIER],
 				'effectDesc' => clienttranslate('#$<SCOUT_2> {2}.#  When I leave the Expedition zone — Create a #<BRASSBUG> Robot# token in my Expedition.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
 		'scout' => 99,
];
  }
}
