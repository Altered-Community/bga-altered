<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_LeviathanWhisperer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_P_BR_84_R1',
            'asset'  => 'ALT_CYCLONE_P_BR_84_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Leviathan Whisperer"),
      'typeline' => clienttranslate("Character - Messenger"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "#N/A",
			'extension'=>'SO',
   'subtypes'  => [MESSENGER],
 				'effectDesc' => clienttranslate('{J} The next Leviathan you play this Afternoon costs {2} less #and gains 1 boost.#'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
