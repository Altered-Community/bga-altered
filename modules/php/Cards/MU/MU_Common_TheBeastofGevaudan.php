<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_TheBeastofGevaudan extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_114_C',
            'asset'  => 'ALT_EOLE_B_MU_114_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("The Beast of Gévaudan"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Victor Canton",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} You may target another Character with {V} less than or equal to mine. It switches Expeditions. (It leaves its Expedition and joins its controller\'s other Expedition.)'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 3, 
];
  }
}
