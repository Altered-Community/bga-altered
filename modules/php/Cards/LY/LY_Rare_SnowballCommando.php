<?php
namespace ALT\Cards\LY;

class LY_Rare_SnowballCommando extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_32_R1',
            'asset'  => 'ALT_ALIZE_B_LY_32_R',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Snowball Commando"),
            'typeline' => clienttranslate("Character - Citizen"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('What goes around comes around!'),
            'artist' => "Zero Wen",
			'extension'=>'TBF',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('{H} You may exhaust ({T}) target card in an opponent\'s Reserve, then roll a die. When you roll a 1-3 this way — That opponent targets a card in your Reserve. Exhaust it.'),
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['forest'], 
];
  }
}
