<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_UrbexSpecialist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_92_C',
            'asset'  => 'ALT_DUSTER_B_LY_92_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Urbex Specialist"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Exploration is always fun with the right company!'),
      'artist' => "DOBA",
			'extension'=>'SDU',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('If I\'m <IN_CONTACT>, my {V}, {M} and {O} are equal to my highest statistic. (I\'m In Contact if another player\'s Expedition is in my region.)'),
     'forest' => 0, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
