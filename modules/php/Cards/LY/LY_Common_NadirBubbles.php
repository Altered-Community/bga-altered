<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_NadirBubbles extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_65_C',
            'asset'  => 'ALT_CYCLONE_B_LY_65_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Nadir & Bubbles"),
      'typeline' => clienttranslate("Hero - 0"),
    	'type'  => HERO,
    	'flavorText'  => clienttranslate('><((((°>'),
      'artist' => "Zero Wen",
			'extension'=>'SO',
   'subtypes'  => [0],
 				'effectDesc' => clienttranslate('I begin the game with one {V}, one {M} and one {O} Terrain Marker.  At Noon — You may place one of my Markers on target visible region. (It gains the terrain of the Marker and loses its other terrains until the Marker is removed.)'),
     'costHand' => 0, 
     'costReserve' => 0, 
];
  }
}
