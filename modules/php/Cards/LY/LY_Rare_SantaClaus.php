<?php
namespace ALT\Cards\LY;

class LY_Rare_SantaClaus extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_37_R1',
            'asset'  => 'ALT_ALIZE_B_LY_37_R',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Santa Claus"),
            'typeline' => clienttranslate("Character - Messenger"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('"Ho ho ho!"'),
            'artist' => "Edward Chee & Seok Yeong",
			'extension'=>'TBF',
   'subtypes'  => [MESSENGER],
 				'effectDesc' => clienttranslate('{H} Starting with you, each player may immediately play a card with Hand Cost {3} or less for free.'),
     'forest' => 0, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 4, 
     'changedStats' => ['mountain','ocean','costHand','costReserve'], 
];
  }
}
