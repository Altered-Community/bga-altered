<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_DredgerDrone extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_50_C',
            'asset'  => 'ALT_BISE_B_AX_50_C',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Dredger Drone"),
            'typeline' => clienttranslate("Character - Robot"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('The more you dig, the better your chances of finding something unique.'),
            'artist' => "Anh Tung",
			'extension'=>'WFTM',
   'subtypes'  => [ROBOT],
 				'effectDesc' => clienttranslate('{R} You may spend 1 of my boosts to <RESUPPLY_INF>. (Put the top card of your deck in Reserve.)'),
 				'supportDesc' => clienttranslate('{I} At Noon — Choose one:  • I gain 1 boost, up to a max of 3.  • {T} : I gain 2 boosts, up to a max of 3.'),
 			     'supportIcon' => 'infinity',
     'forest' => 1, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 3, 
];
  }
}
