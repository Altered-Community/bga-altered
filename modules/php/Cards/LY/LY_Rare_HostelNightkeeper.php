<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_HostelNightkeeper extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_95_R1',
            'asset'  => 'ALT_DUSTER_B_LY_95_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Hostel Nightkeeper"),
      'typeline' => clienttranslate("Character - Merchant"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Floor -2, room 217. Welcome to the Underlook Hostel."'),
      'artist' => "Anh Tung",
			'extension'=>'SDU',
   'subtypes'  => [MERCHANT],
 				'effectDesc' => clienttranslate('{H} You may target a Character, it gains <ASLEEP>. #If you control it,# create a <MANASEED> token in your Landmarks.'),
     'forest' => 4, 
     'mountain' => 2, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 3, 
     'changedStats' => ['mountain'], 
];
  }
}
