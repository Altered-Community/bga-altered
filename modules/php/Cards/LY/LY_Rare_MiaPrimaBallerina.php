<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_MiaPrimaBallerina extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_114_R1',
            'asset'  => 'ALT_EOLE_B_LY_114_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Mia, Prima Ballerina"),
      'typeline' => clienttranslate("Character - Artist"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [ARTIST],
 				'effectDesc' => clienttranslate('#When you pass — You may have me activate my {D} ability. If you do, I gain <FLEETING_CHAR>.#'),
 				'supportDesc' => clienttranslate('{D} : Target Character gains <FLEETING>.'),
 			     'supportIcon' => 'discard',
     'forest' => 5, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
