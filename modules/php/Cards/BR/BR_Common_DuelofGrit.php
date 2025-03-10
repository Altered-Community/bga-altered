<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_DuelofGrit extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_61_C',
            'asset'  => 'ALT_BISE_B_BR_61_C',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Duel of Grit"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('Fiore was the first of the Seven Blades to clash with Atsadi.'),
            'artist' => "Ed Chee, S.Yong & Stephen",
			'extension'=>'WFTM',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('$<FLEETING>.  Send to Reserve target Character with Hand Cost less than or equal to the Hand Cost of a Character you control.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
