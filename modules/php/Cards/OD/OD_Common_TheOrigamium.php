<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_TheOrigamium extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_82_C',
            'asset'  => 'ALT_CYCLONE_B_OR_82_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("The Origamium"),
      'typeline' => clienttranslate("Landmark_permanent - Construction"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('Where paper heralds take flight.'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SO',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Target Expedition <ASCENDS>. (Until Rest, it can move forward even if matched in its region\'s terrains by the opponent\'s Expedition.)  When you play a Character — If it\'s in an Ascended Expedition, you may exhaust me ({T}) to give it 1 boost.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
