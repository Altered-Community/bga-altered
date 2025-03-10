<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_RunesTestament extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_61_R1',
            'asset'  => 'ALT_BISE_B_OR_61_R',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Rune's Testament"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('The first High King of Asgartha urges us to venture forth!'),
            'artist' => "Fahmi Fauzi",
			'extension'=>'WFTM',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('If my Expedition would move forward, you may discard me instead to #look at the top four cards of your deck. Put one in your hand and discard the others.#'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
