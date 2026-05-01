<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_LakshmisOwl extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_119_R1',
            'asset'  => 'ALT_EOLE_B_LY_119_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Lakshmi's Owl"),
      'typeline' => clienttranslate("Character - Animal Spirit"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Fahmi Fauzi",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL,SPIRIT],
 				'effectDesc' => clienttranslate('When you roll one or more dice — If I have no boosts, #I gain 1 boost.#'),
 				'supportDesc' => clienttranslate('#{D} : Pay {1} less for the next Character you play this turn, down to a minimum of {1}.#'),
 			     'supportIcon' => 'discard',
     'forest' => 0, 
     'mountain' => 1, 
     'ocean' => 0, 
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
