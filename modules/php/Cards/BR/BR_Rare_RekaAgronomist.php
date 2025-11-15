<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_RekaAgronomist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_91_R2',
            'asset'  => 'ALT_DUSTER_B_MU_91_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reka Agronomist"),
      'typeline' => clienttranslate("Character - Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"By crossing the fruits of the two world trees, we could obtain a fertile specimen."'),
      'artist' => "Matteo Spirito",
			'extension'=>'SDU',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('{H} Create a <MANASEED> token in #another target player\'s# Landmarks.'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
