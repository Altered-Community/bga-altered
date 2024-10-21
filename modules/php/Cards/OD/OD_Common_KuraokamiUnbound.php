<?php
namespace ALT\Cards\OD;

class OD_Common_KuraokamiUnbound extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_P_OR_48_C',
            'asset'  => 'ALT_ALIZE_P_OR_48_C',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Kuraokami Unbound"),
            'typeline' => clienttranslate("Character - Dragon Deity"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate(''),
            'artist' => "",
			'extension'=>'TBF',
   'subtypes'  => [DRAGON,DEITY],
 				'effectDesc' => clienttranslate('{H} Exhaust all cards in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 6, 
     'costReserve' => 5, 
];
  }
}
