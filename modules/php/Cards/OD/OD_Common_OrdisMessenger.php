<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_OrdisMessenger extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_72_C',
            'asset'  => 'ALT_CYCLONE_B_OR_72_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Ordis Messenger"),
      'typeline' => clienttranslate("Character - Messenger"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('To maintain their cohesion, the Ordis must call on the most reliable of couriers.'),
      'artist' => "Ed Chee, S.Yong & Stephen",
			'extension'=>'SO',
   'subtypes'  => [MESSENGER],
 				'effectDesc' => clienttranslate('{H} If I\'m in an Ascended Expedition, <RESUPPLY_LOW>. Otherwise, my Expedition <ASCENDS>. (Until Rest, it can move forward even if matched in its region\'s terrains by the opponent\'s Expedition.)'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
