<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_BoldOutrider extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_112_R1',
            'asset'  => 'ALT_EOLE_B_BR_112_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Bold Outrider"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Fahmi Fauzi",
			'extension'=>'ROC',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('#{J} You may immediately play a Feat for {1} less, down to a minimum of {1}.#'),
 				'supportDesc' => clienttranslate('#{D} : The next Character you play this turn gains 1 boost.#'),
 			     'supportIcon' => 'discard',
     'forest' => 3, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
