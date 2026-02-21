<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_WhiteFang extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_109_C',
            'asset'  => 'ALT_EOLE_B_MU_109_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("White Fang"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jefrey Yonathan",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'supportDesc' => clienttranslate('{D} : The next Character you play this turn gains 1 boost.'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
