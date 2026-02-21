<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_WhiteFang extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_109_R1',
            'asset'  => 'ALT_EOLE_B_MU_109_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("White Fang"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jefrey Yonathan",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('#{H} Create a <WOOLLYBACK> Animal token in another target Expedition.#'),
 				'supportDesc' => clienttranslate('{D} : The next Character you play this turn gains 1 boost.'),
 			     'supportIcon' => 'discard',
     'forest' => 0, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 1, 
     'changedStats' => ['forest','costReserve'], 
];
  }
}
