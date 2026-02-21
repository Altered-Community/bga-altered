<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_Carbunclo extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_112_R2',
            'asset'  => 'ALT_EOLE_B_LY_112_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Carbunclo"),
      'typeline' => clienttranslate("Character - Animal Spirit"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL,SPIRIT],
 				'effectDesc' => clienttranslate('#{J} If I\'m in an <ASCENDED_S> Expedition,# <RESUPPLY_LOW>.'),
     'forest' => 2, 
     'mountain' => 0, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['mountain'], 
];
  }
}
