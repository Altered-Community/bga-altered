<?php
namespace ALT\Cards\YZ;

class YZ_Rare_SnowballCommando extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_32_R2',
            'asset'  => 'ALT_ALIZE_B_LY_32_R2',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Snowball Commando"),
            'typeline' => clienttranslate("Character - Citizen"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('What goes around comes around!'),
            'artist' => "Zero Wen",
			'extension'=>'TBF',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('{H} You may exhaust ({T}) target card in an opponent\'s Reserve, then roll a die. When you roll a 1-3 this way — That opponent targets a card in your Reserve. Exhaust it.'),
     'forest' => 0, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
