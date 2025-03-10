<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_PastryChef extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_54_C',
            'asset'  => 'ALT_BISE_B_BR_54_C',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Pastry Chef"),
            'typeline' => clienttranslate("Character - Citizen"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Pioneers in more ways than one, the Bravos were the first to experiment with Sap in the culinary arts.'),
            'artist' => "Nestor Papatriantafyllou",
			'extension'=>'WFTM',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('{R} If I have 2 or more boosts, draw a card.'),
 				'supportDesc' => clienttranslate('{I} When you play another Character — I gain 1 boost, up to a max of 3.'),
 			     'supportIcon' => 'infinity',
     'forest' => 2, 
     'mountain' => 4, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 5, 
];
  }
}
