<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_DesignerDrone extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_51_C',
            'asset'  => 'ALT_BISE_B_AX_51_C',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Designer Drone"),
            'typeline' => clienttranslate("Character - Robot Engineer"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Designed by designers to help them design.'),
            'artist' => "Anh Tung",
			'extension'=>'WFTM',
   'subtypes'  => [ROBOT,ENGINEER],
 				'supportDesc' => clienttranslate('{I} At Noon — Choose one:  • I gain 1 boost, up to a max of 3.  • {T} : I gain 2 boosts, up to a max of 3.'),
 			     'supportIcon' => 'infinity',
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 3, 
];
  }
}
