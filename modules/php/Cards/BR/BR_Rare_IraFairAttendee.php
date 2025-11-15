<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_IraFairAttendee extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_88_R2',
            'asset'  => 'ALT_DUSTER_B_AX_88_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Ira, Fair Attendee"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"One day, son, you\'ll show off your own creations here." — Della'),
      'artist' => "Tristan Bideau",
			'extension'=>'SDU',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('#{R} Create a <MANASEED> token in your Landmarks.#'),
     'forest' => 2, 
     'mountain' => 0, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 2, 
     'changedStats' => ['forest','costReserve'], 
];
  }
}
