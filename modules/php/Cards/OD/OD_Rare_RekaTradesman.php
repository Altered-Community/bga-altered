<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_RekaTradesman extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_87_R2',
            'asset'  => 'ALT_DUSTER_B_MU_87_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reka Tradesman"),
      'typeline' => clienttranslate("Character - Merchant"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Here\'s one for the road."'),
      'artist' => "Jefrey Yonathan",
			'extension'=>'SDU',
   'subtypes'  => [MERCHANT],
 				'effectDesc' => clienttranslate('{R} Put the top card of your deck #in your Mana zone# (as an exhausted Mana Orb), then create a <MANASEED> token in target opponent\'s Landmarks.'),
     'forest' => 0, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 3, 
     'changedStats' => ['costReserve'], 
];
  }
}
