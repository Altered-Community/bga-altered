<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_Halua extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_83_C',
            'asset'  => 'ALT_CYCLONE_B_BR_83_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Halua"),
      'typeline' => clienttranslate("Token - Companion Leviathan"),
    	'type'  => TOKEN,
    	'flavorText'  => clienttranslate('So close to the enemy that they become your friend...'),
      'artist' => "Matteo Spirito",
			'extension'=>'SO',
   'subtypes'  => [COMPANION,LEVIATHAN],
 				'effectDesc' => clienttranslate('If your Hero has 5 or more Quest counters, I am <GIGANTIC>. (A Gigantic Character is considered present in both Expeditions. When I leave the Expedition zone, remove me from the game.)'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 0, 
     'costReserve' => 0, 
 		'gigantic' => true,
];
  }
}
