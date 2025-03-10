<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_Encore extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_59_C',
            'asset'  => 'ALT_BISE_B_LY_59_C',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Encore"),
            'typeline' => clienttranslate("Spell - Song"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('Ready for more?'),
            'artist' => "Justice Wong",
			'extension'=>'WFTM',
   'subtypes'  => [SONG],
 				'effectDesc' => clienttranslate('Target <FLEETING_CHAR> Character gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)'),
     'costHand' => 2, 
     'costReserve' => 3, 
];
  }
}
