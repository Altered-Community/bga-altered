<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_SapDispersal extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_59_C',
            'asset'  => 'ALT_BISE_B_MU_59_C',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Sap Dispersal"),
            'typeline' => clienttranslate("Spell - Boon"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('20% Sap, 40% water, 40% love... and 100% organic.'),
            'artist' => "Zael",
			'extension'=>'WFTM',
   'subtypes'  => [BOON],
 				'effectDesc' => clienttranslate('Characters in your Reserve gain 1 boost.'),
     'costHand' => 1, 
     'costReserve' => 2, 
];
  }
}
