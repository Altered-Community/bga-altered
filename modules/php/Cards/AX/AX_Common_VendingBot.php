<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_VendingBot extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_91_C',
            'asset'  => 'ALT_DUSTER_B_AX_91_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Vending Bot"),
      'typeline' => clienttranslate("Character - Robot Merchant"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Sap Cola! Pepsap! Guaranteed sugar-free!"'),
      'artist' => "Anh Tung",
			'extension'=>'SDU',
   'subtypes'  => [ROBOT,MERCHANT],
 				'effectDesc' => clienttranslate('{R} <EXHAUSTED_RESUPPLY>. (Put the top card of your deck in Reserve, then exhaust it {T}. Exhausted cards can\'t be played and have no Support abilities.)'),
     'forest' => 0, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
