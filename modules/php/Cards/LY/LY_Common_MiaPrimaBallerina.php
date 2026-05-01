<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_MiaPrimaBallerina extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_114_C',
            'asset'  => 'ALT_EOLE_B_LY_114_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Mia, Prima Ballerina"),
      'typeline' => clienttranslate("Character - Artist"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [ARTIST],
 				'supportDesc' => clienttranslate('{D} : Target Character gains <FLEETING>. (Discard me from Reserve to do this.)'),
 			     'supportIcon' => 'discard',
     'forest' => 5, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
