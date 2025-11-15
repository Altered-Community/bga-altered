<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_CharitableReka extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_89_R2',
            'asset'  => 'ALT_DUSTER_B_MU_89_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Charitable Reka"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Opulence is a state of grace that forever teeters on the precipice.'),
      'artist' => "Ba Vo",
			'extension'=>'SDU',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('#{J} Create a <MANASEED> token in each player\'s Landmarks.#'),
     'forest' => 3, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
