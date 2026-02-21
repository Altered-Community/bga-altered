<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_Dawon extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_111_C',
            'asset'  => 'ALT_EOLE_B_MU_111_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Dawon"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Victor Canton",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} You may target another Character with {V} less than or equal to mine. It gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)'),
     'forest' => 2, 
     'mountain' => 0, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
