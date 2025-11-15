<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_DioclesChariotRacer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_93_R1',
            'asset'  => 'ALT_DUSTER_B_LY_93_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Diocles, Chariot Racer"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Hop in, it\'s a guaranteed five-star experience!"'),
      'artist' => "Damian Audino",
			'extension'=>'SDU',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('#Pay {3} more# to play me in a starting region.  {J} My Expedition moves backwards one region.  When I leave the Expedition zone — My Expedition moves forward one region.'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
