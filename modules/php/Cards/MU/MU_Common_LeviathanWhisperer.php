<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_LeviathanWhisperer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_P_MU_84_C',
            'asset'  => 'ALT_CYCLONE_P_MU_84_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Leviathan Whisperer"),
      'typeline' => clienttranslate("Character - Messenger"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "#N/A",
			'extension'=>'SO',
   'subtypes'  => [MESSENGER],
 				'effectDesc' => clienttranslate('{J} The next Leviathan you play this Afternoon costs {2} less.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
