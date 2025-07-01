<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_Eris extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_75_R2',
            'asset'  => 'ALT_CYCLONE_B_LY_75_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Eris"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('You win some, you lose some.'),
      'artist' => "Zero Wen",
			'extension'=>'SO',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('If my Expedition would move forward during Dusk, roll a die. On a:  • 4+, it moves forward one more region instead.  #• 1, it doesn\'t move instead.#'),
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 5, 
     'costReserve' => 5, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
