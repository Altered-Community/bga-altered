<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_IsareePebble extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_65_C',
            'asset'  => 'ALT_CYCLONE_B_AX_65_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Isaree & Pebble"),
      'typeline' => clienttranslate("Hero - 0"),
    	'type'  => HERO,
    	'flavorText'  => clienttranslate('Science\'s role is to serve the people, not the other way around'),
      'artist' => "Justice Wong",
			'extension'=>'SO',
   'subtypes'  => [0],
 				'effectDesc' => clienttranslate('At Noon — If you are first player, create an <AEROLITH> token in your Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")'),
     'costHand' => 0, 
     'costReserve' => 0, 
];
  }
}
