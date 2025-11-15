<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_RekaGatherer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_94_C',
            'asset'  => 'ALT_DUSTER_B_MU_94_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Reka Gatherer"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('There always comes a time to reap what we sow.'),
      'artist' => "Bastien Jez",
			'extension'=>'SDU',
   'subtypes'  => [CITIZEN],
 				'supportDesc' => clienttranslate('{D} : Create a <MANASEED> token in each player\'s Landmarks. (It\'s a Permanent with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
