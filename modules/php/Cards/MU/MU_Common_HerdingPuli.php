<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_HerdingPuli extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_106_C',
            'asset'  => 'ALT_EOLE_B_MU_106_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Herding Puli"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Victor Canton",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{J} Create a <WOOLLYBACK> Animal token in the Expedition facing me. It gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)'),
     'forest' => 1, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
