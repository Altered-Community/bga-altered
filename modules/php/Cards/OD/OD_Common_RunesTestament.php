<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_RunesTestament extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_61_C',
            'asset'  => 'ALT_BISE_B_OR_61_C',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Rune's Testament"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('The first High King of Asgartha urges us to venture forth!'),
            'artist' => "Fahmi Fauzi",
			'extension'=>'WFTM',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('If my Expedition would move forward, you may discard me instead to draw two cards.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
