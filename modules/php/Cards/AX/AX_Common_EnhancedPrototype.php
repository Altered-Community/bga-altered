<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_EnhancedPrototype extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_57_C',
            'asset'  => 'ALT_BISE_B_AX_57_C',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Enhanced Prototype"),
            'typeline' => clienttranslate("Character - Robot"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('It\'s no longer flawed, but there\'s still room for improvement.'),
            'artist' => "Anh Tung",
			'extension'=>'WFTM',
   'subtypes'  => [ROBOT],
 				'effectDesc' => clienttranslate('{R} You may spend 1 of my boosts to ready two Mana Orbs.'),
 				'supportDesc' => clienttranslate('{I} At Noon — Choose one:  • I gain 1 boost, up to a max of 3.  • {T} : I gain 2 boosts, up to a max of 3.'),
 			     'supportIcon' => 'infinity',
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 5, 
     'costReserve' => 6, 
];
  }
}
