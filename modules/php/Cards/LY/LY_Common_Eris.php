<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_Eris extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_75_C',
            'asset'  => 'ALT_CYCLONE_B_LY_75_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Eris"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('You win some, you lose some.'),
      'artist' => "Zero Wen",
			'extension'=>'SO',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('If my Expedition would move forward during Dusk, roll a die. On a 4+: it moves forward one more region instead.'),
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 6, 
     'costReserve' => 6, 
];
  }
}
