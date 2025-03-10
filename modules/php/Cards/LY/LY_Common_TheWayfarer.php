<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_TheWayfarer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_62_C',
            'asset'  => 'ALT_BISE_B_LY_62_C',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("The Wayfarer"),
            'typeline' => clienttranslate("Landmark_permanent - Construction"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('The Tisdhera Clan answers its Matriarch\'s call!'),
            'artist' => "Fahmi Fauzi",
			'extension'=>'WFTM',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('If you would roll one or more dice, also reveal the top card of your deck.  When you reveal a card this way — If its Hand Cost is equal to the die\'s result, draw it.'),
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
