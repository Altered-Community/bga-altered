<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_RekaGuide extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_87_R2',
            'asset'  => 'ALT_DUSTER_B_LY_87_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reka Guide"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Let\'s wrap up today\'s visit with a taste of some local specialties."'),
      'artist' => "DOBA",
			'extension'=>'SDU',
   'subtypes'  => [CITIZEN],
 				'supportDesc' => clienttranslate('{D} : Return another Character from your Reserve to your hand.'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['ocean'], 
];
  }
}
