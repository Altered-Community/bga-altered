<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_RekaFixer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_115_R2',
            'asset'  => 'ALT_EOLE_B_BR_115_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reka Fixer"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Andy Jauffrit",
			'extension'=>'ROC',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('{R} If you control a Feat, <RESUPPLY_LOW>. #If it\'s <COMPLETED_LOW>, draw a card instead.#'),
 				'supportDesc' => clienttranslate('{D} : The next Character you play this turn gains 1 boost.'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 3, 
     'changedStats' => ['forest'], 
];
  }
}
