<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_Nephele extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_96_C',
            'asset'  => 'ALT_DUSTER_B_BR_96_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Nephele"),
      'typeline' => clienttranslate("Character - Fairy"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Even the brightest day of sunshine has its clouds.'),
      'artist' => "Taras Susak",
			'extension'=>'SDU',
   'subtypes'  => [FAIRY],
 				'effectDesc' => clienttranslate('{J} You may pass. If you don\'t, create a <MANASEED> token in target opponent\'s Landmarks. (It\'s a Permanent with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
     'forest' => 5, 
     'mountain' => 3, 
     'ocean' => 5, 
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
