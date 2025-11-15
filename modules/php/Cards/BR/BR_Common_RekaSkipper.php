<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_RekaSkipper extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_87_C',
            'asset'  => 'ALT_DUSTER_B_BR_87_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Reka Skipper"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Into the great wide open.'),
      'artist' => "Jefrey Yonathan",
			'extension'=>'SDU',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('When my Expedition moves forward — Create a <MANASEED> token in your Landmarks. (It\'s a Permanent with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
     'forest' => 0, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 3, 
];
  }
}
