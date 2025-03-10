<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_TheLittleMouse extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_53_R2',
            'asset'  => 'ALT_BISE_B_MU_53_R',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("The Little Mouse"),
            'typeline' => clienttranslate("Character - Animal"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('It fights tooth-for-tooth with the fairy.'),
            'artist' => "Jean-Baptiste Andrier",
			'extension'=>'WFTM',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('#{J}# <SABOTAGE>. If you discarded a card this way, its owner <EXHAUSTED_RESUPPLIES>. (They put the top card of their deck in Reserve, then they exhaust it {T}. Exhausted cards can\'t be played and have no Support abilities.)'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['forest','costReserve'], 
];
  }
}
