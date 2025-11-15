<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_RekaSkipper extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_87_R2',
            'asset'  => 'ALT_DUSTER_B_BR_87_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reka Skipper"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Into the great wide open.'),
      'artist' => "Jefrey Yonathan",
			'extension'=>'SDU',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('When my Expedition moves forward — Create a <MANASEED> token in your Landmarks.'),
     'forest' => 0, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 3, 
];
  }
}
