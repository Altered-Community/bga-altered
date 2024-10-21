<?php
namespace ALT\Cards\OD;

class OD_Common_Benzaiten extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_46_C',
            'asset'  => 'ALT_ALIZE_B_OR_46_C',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Benzaiten"),
            'typeline' => clienttranslate("Character - Deity"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Good things come to those who wait.'),
            'artist' => "Zero Wen",
			'extension'=>'TBF',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('{J} If my Expedition is behind, draw a card.'),
     'forest' => 6, 
     'mountain' => 6, 
     'ocean' => 6, 
     'costHand' => 6, 
     'costReserve' => 6, 
];
  }
}
