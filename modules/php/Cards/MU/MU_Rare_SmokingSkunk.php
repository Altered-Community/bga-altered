<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_SmokingSkunk extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_106_R2',
            'asset'  => 'ALT_EOLE_B_LY_106_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Smoking Skunk"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Kevin Sidharta",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('#Other Characters in your Expeditions are <TOUGH_CHA_P_1>.#'),
 				'supportDesc' => clienttranslate('{D} : Pay {1} less for the next Character you play this turn, down to a minimum of {1}.'),
 			     'supportIcon' => 'discard',
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['ocean','costHand','costReserve'], 
];
  }
}
