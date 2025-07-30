<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_OrdisMessenger extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_72_R2',
            'asset'  => 'ALT_CYCLONE_B_OR_72_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Ordis Messenger"),
      'typeline' => clienttranslate("Character - Messenger"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('To maintain their cohesion, the Ordis must call on the most reliable of couriers.'),
      'artist' => "Ed Chee, S.Yong & Stephen",
			'extension'=>'SO',
   'subtypes'  => [MESSENGER],
 				'effectDesc' => clienttranslate('#{J}# If I\'m in an Ascended Expedition, #create an <AEROLITH> token in target player\'s Landmarks.# Otherwise, my Expedition <ASCENDS>.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand'], 
];
  }
}
