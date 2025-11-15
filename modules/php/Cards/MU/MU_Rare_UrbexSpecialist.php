<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_UrbexSpecialist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_92_R2',
            'asset'  => 'ALT_DUSTER_B_LY_92_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Urbex Specialist"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Exploration is always fun with the right company!'),
      'artist' => "DOBA",
			'extension'=>'SDU',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('If I\'m #in {V},# my {V}, {M} and {O} are equal to my highest statistic.  #{J} If I\'m not in {V}, I gain 1 boost.#'),
     'forest' => 0, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 2, 
     'changedStats' => ['ocean'], 
];
  }
}
