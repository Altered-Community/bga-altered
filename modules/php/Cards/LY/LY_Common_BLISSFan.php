<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_BLISSFan extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_50_C',
            'asset'  => 'ALT_BISE_B_LY_50_C',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("BLISS Fan"),
            'typeline' => clienttranslate("Character - Artist"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('BLISS lets the fans who bring back the most Sap come up on stage with them.'),
            'artist' => "Aaron Ming",
			'extension'=>'WFTM',
   'subtypes'  => [ARTIST],
 				'effectDesc' => clienttranslate('When a Character in your Reserve gains 1 or more boosts — I gain 1 boost.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 1, 
];
  }
}
