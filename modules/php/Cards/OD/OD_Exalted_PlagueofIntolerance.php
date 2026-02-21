<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Exalted_PlagueofIntolerance extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_117_E',
            'asset'  => 'ALT_EOLE_B_OR_117_E',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_EXALTED,
    	'name'  => clienttranslate("Plague of Intolerance"),
      'typeline' => clienttranslate("Character - Corruption"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION],
 				'effectDesc' => clienttranslate('{H} Sacrifice a Character. Then, depending on the number of Characters in your Expeditions:  • 2+: Draw a card.  • 4+: I also gain 2 boosts.  • 6+: Each other Character in your Expeditions also gains 1 boost.'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 3, 
];
  }
}
