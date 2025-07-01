<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_MountainNymph extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_70_C',
            'asset'  => 'ALT_CYCLONE_B_LY_70_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Mountain Nymph"),
      'typeline' => clienttranslate("Character - Fairy"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('From a mere pebble, she creates a sparkling jewel.'),
      'artist' => "Tristan Bideau",
			'extension'=>'SO',
   'subtypes'  => [FAIRY],
 				'effectDesc' => clienttranslate('{H} If I\'m facing an Expedition in {M}, create an <AEROLITH> token in your Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")'),
     'forest' => 0, 
     'mountain' => 4, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
