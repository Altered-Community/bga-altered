<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_RekaWelder extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_122_C',
            'asset'  => 'ALT_EOLE_B_AX_122_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Reka Welder"),
      'typeline' => clienttranslate("Character - Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung",
			'extension'=>'ROC',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('You play Permanents for {1} less, down to a minimum of {1}. (Other effects may reduce it further.)'),
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'reduceCostType' => [PERMANENT => ['minBaseCost' => 2, 'reduction' => 1]],
];
  }
}
