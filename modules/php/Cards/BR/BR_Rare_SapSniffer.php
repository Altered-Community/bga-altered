<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_SapSniffer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_49_R2',
            'asset'  => 'ALT_BISE_B_AX_49_R',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Sap Sniffer"),
            'typeline' => clienttranslate("Character - Animal"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Indigenous to the ruins, these little creatures can smell Sap from a mile away.'),
            'artist' => "Kevin Sidharta",
			'extension'=>'WFTM',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{R} You may <AUGMENT> target card in play or in Reserve. (If it has counters, it gains 1 more. This can\'t target Hero cards.)'),
     'forest' => 0, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
