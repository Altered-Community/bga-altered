<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_NilsHolgersson extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_106_R1',
            'asset'  => 'ALT_EOLE_B_OR_106_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Nils Holgersson"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Ba Vo",
			'extension'=>'ROC',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('#{H} You may target a Character with Base Cost {1} or less. It switches Expeditions.#'),
 				'supportDesc' => clienttranslate('#{D} : Create an <ORDIS_RECRUIT> Soldier token in target Expedition.#'),
 			     'supportIcon' => 'discard',
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
