<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_AdamantReceptionist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_91_R2',
            'asset'  => 'ALT_DUSTER_B_OR_91_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Adamant Receptionist"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"You\'re not on the list. Please move along."'),
      'artist' => "Aleksandr Leskinen",
			'extension'=>'SDU',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('{H} You may exhaust ({T}) a #card in your Reserve# to <SABOTAGE_INF>.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
