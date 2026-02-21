<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_Pegasus extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_115_C',
            'asset'  => 'ALT_EOLE_B_OR_115_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Pegasus"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "DOBA",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('When my Expedition would move forward <DUE_TO_ASCENSION>, it moves forward one more region instead. (If it moved forward due to at least one matched stat.)'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 4, 
     'costHand' => 5, 
     'costReserve' => 5, 
];
  }
}
