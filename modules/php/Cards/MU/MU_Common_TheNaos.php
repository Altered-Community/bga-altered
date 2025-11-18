<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_TheNaos extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_102_C',
            'asset'  => 'ALT_DUSTER_B_MU_102_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("The Naos"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('Patiently, the Reka waited for their new world tree to grow.'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SDU',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('$<TOUGH_1>.  At Noon — Draw a card, then create two <MANASEED> tokens in your Landmarks. (They are Permanents with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
     'costHand' => 6, 
     'costReserve' => 6, 
 		'tough'=>1,
];
  }
}
