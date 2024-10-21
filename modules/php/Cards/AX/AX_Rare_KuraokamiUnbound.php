<?php
namespace ALT\Cards\AX;

class AX_Rare_KuraokamiUnbound extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_P_AX_48_R1',
            'asset'  => 'ALT_ALIZE_P_AX_48_R',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Kuraokami Unbound"),
            'typeline' => clienttranslate("Character - Dragon Deity"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate(''),
            'artist' => "",
			'extension'=>'TBF',
   'subtypes'  => [DRAGON,DEITY],
 				'effectDesc' => clienttranslate('#{J}# Exhaust all cards in Reserve#, then ready your cards in Reserve#.'),
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 6, 
     'costReserve' => 5, 
];
  }
}
