<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_Pegasus extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_115_R1',
            'asset'  => 'ALT_EOLE_B_OR_115_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Pegasus"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "DOBA",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('#{J} Each of your Expeditions <ASCENDS>.#   When #both of your Expeditions# move forward <DUE_TO_ASCENSION> — #You win the game.#'),
     'forest' => 3, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 5, 
     'costReserve' => 5, 
     'changedStats' => ['mountain'], 
];
  }
}
