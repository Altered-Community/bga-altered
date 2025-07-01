<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_BravosHarpooner extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_73_R1',
            'asset'  => 'ALT_CYCLONE_B_BR_73_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Bravos Harpooner"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Without explosive charges, these harpoons wouldn\'t even make a dent in Halua\'s hide.'),
      'artist' => "Justice Wong",
			'extension'=>'SO',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('The '),
     'forest' => 3, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['mountain'], 
];
  }
}
