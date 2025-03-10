<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_TheMess extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_63_R1',
            'asset'  => 'ALT_BISE_B_BR_63_R',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("The Mess"),
            'typeline' => clienttranslate("Landmark_permanent - Construction"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Every evening, the Mess overflows with laughter and shouting as explorers share their daily exploits.'),
            'artist' => "Fahmi Fauzi",
			'extension'=>'WFTM',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('When a #non-token# Character leaves your Expeditions — I gain 1 Food counter.  {T}, #Spend 4# of my Food counters: #draw a card.#'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
