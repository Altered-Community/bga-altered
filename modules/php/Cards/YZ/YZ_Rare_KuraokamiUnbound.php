<?php
namespace ALT\Cards\YZ;

class YZ_Rare_KuraokamiUnbound extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_P_YZ_48_R1',
            'asset'  => 'ALT_ALIZE_P_YZ_48_R',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Kuraokami Unbound"),
            'typeline' => clienttranslate("Character - Dragon Deity"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate(''),
            'artist' => "",
			'extension'=>'TBF',
   'subtypes'  => [DRAGON,DEITY],
 				'effectDesc' => clienttranslate('{H} #Target opponent puts a card from their hand in Reserve. Then,# exhaust all cards in Reserve.'),
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 7, 
     'costReserve' => 5, 
     'changedStats' => ['costHand'], 
];
  }
}
