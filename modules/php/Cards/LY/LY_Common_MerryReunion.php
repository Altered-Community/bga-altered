<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_MerryReunion extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_58_C',
            'asset'  => 'ALT_BISE_B_LY_58_C',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Merry Reunion"),
            'typeline' => clienttranslate("Spell - Conjuration"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('"Dad!" — Sierra'),
            'artist' => "Ina Wong",
			'extension'=>'WFTM',
   'subtypes'  => [CONJURATION],
 				'effectDesc' => clienttranslate('$<RESUPPLY>. If you put a Character in Reserve this way, you may immediately play it for {2} less.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
