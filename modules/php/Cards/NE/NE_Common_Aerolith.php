<?php
namespace ALT\Cards\NE;
use ALT\Helpers\FT;

class NE_Common_Aerolith extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_NE_03_C',
            'asset'  => 'ALT_CYCLONE_B_NE_03_C',

    	'faction'  => FACTION_NE,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Aerolith"),
      'typeline' => clienttranslate("Token_landmark_permanent - Ore"),
    	'type'  => TOKEN_LANDMARK_PERMANENT,
    	'flavorText'  => clienttranslate('With aerolith, gravity no longer constrains how we build.'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SO',
   'subtypes'  => [ORE],
 				'effectDesc' => clienttranslate('When I\'m sacrificed — <RESUPPLY>. (Put the top card of your deck in Reserve. Excess Landmarks are sacrificed at the end of the Day.)  {T}, {1} : Sacrifice me.'),
     'costHand' => 0, 
     'costReserve' => 0, 
];
  }
}
