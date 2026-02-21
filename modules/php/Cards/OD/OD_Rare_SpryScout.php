<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_SpryScout extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_109_R2',
            'asset'  => 'ALT_EOLE_B_BR_109_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Spry Scout"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Kevin Sidharta",
			'extension'=>'ROC',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('{R} If you control a Feat, I gain 1 boost. #If it\'s <COMPLETED_LOW>, up to two target Characters each gain 1 boost instead.#'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
