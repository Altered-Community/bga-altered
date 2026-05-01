<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_RekaRopedancer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_110_R2',
            'asset'  => 'ALT_EOLE_B_LY_110_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reka Ropedancer"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Saeed Jalabi",
			'extension'=>'ROC',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('#{J} Target Character with a {D} ability in play or in Reserve gains 1 boost.#'),
 				'supportDesc' => clienttranslate('{D} : The next Character you play this turn gains 1 boost and <ASLEEP>.'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 4, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['ocean','costReserve'], 
];
  }
}
