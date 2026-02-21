<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_StigmaofHavoc extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_115_R2',
            'asset'  => 'ALT_EOLE_B_LY_115_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Stigma of Havoc"),
      'typeline' => clienttranslate("Character - Corruption"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Khoa Viet",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION],
 				'effectDesc' => clienttranslate('{H} Each player discards their Reserve, then #<RESUPPLIES>.#  #{J} <RESUPPLY>.#'),
 				'supportDesc' => clienttranslate('{D} : Create an <AEROLITH> token in target player\'s Landmarks.'),
 			     'supportIcon' => 'discard',
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 6, 
     'costHand' => 5, 
     'costReserve' => 5, 
     'changedStats' => ['costHand'], 
];
  }
}
