<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_HostelNightkeeper extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_95_C',
            'asset'  => 'ALT_DUSTER_B_LY_95_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Hostel Nightkeeper"),
      'typeline' => clienttranslate("Character - Merchant"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Floor -2, room 217. Welcome to the Underlook Hostel."'),
      'artist' => "Anh Tung",
			'extension'=>'SDU',
   'subtypes'  => [MERCHANT],
 				'effectDesc' => clienttranslate('{H} You may target a Character. If you do, it gains <ASLEEP>, then create a <MANASEED> token in its controller\'s Landmarks. (It\'s a Permanent with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
     'forest' => 4, 
     'mountain' => 0, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 3, 
];
  }
}
