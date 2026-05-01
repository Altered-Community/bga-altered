<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_NilsHolgersson extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_106_C',
            'asset'  => 'ALT_EOLE_B_OR_106_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Nils Holgersson"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Ba Vo",
			'extension'=>'ROC',
   'subtypes'  => [CITIZEN],
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
