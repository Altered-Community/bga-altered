<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_RekaRopedancer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_110_C',
            'asset'  => 'ALT_EOLE_B_LY_110_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Reka Ropedancer"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Saeed Jalabi",
			'extension'=>'ROC',
   'subtypes'  => [ADVENTURER],
 				'supportDesc' => clienttranslate('{D} : The next Character you play this turn gains 1 boost and <ASLEEP>.'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 4, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
