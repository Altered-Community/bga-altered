<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_RekaThurifer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_116_R2',
            'asset'  => 'ALT_EOLE_B_LY_116_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reka Thurifer"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "DOBA",
			'extension'=>'ROC',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('#Play me for {1} less if six or more cards are in your discard pile.#  {H} <SABOTAGE>.'),
 				'supportDesc' => clienttranslate('{D} : Pay {1} less for the next #Spell# you play this turn, down to a minimum of {1}.'),
 			     'supportIcon' => 'discard',
     'forest' => 4, 
     'mountain' => 0, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 4, 
     'changedStats' => ['costReserve'], 
];
  }
}
