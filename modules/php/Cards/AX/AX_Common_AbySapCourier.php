<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_AbySapCourier extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_54_C',
            'asset'  => 'ALT_BISE_B_AX_54_C',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Aby, Sap Courier"),
            'typeline' => clienttranslate("Character - Engineer Messenger"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('This wheel is the result of hours of mechanical training.'),
            'artist' => "Aaron Ming",
			'extension'=>'WFTM',
   'subtypes'  => [ENGINEER,MESSENGER],
 				'effectDesc' => clienttranslate('$<SCOUT_1> {1}. {J} You may <AUGMENT> target card in play or in Reserve. (If it has counters, it gains 1 more. This can\'t target Hero cards.)'),
     'forest' => 3, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
 		'scout' => 99,
];
  }
}
