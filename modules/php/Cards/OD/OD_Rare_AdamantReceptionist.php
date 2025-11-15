<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_AdamantReceptionist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_91_R1',
            'asset'  => 'ALT_DUSTER_B_OR_91_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Adamant Receptionist"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"You\'re not on the list. Please move along."'),
      'artist' => "Aleksandr Leskinen",
			'extension'=>'SDU',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('#{J}# You may exhaust ({T}) a Permanent you control to <SABOTAGE_INF>. #If you don\'t, I gain 1 boost.#'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['costReserve'], 
];
  }
}
