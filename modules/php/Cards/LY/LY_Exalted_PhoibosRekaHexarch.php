<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Exalted_PhoibosRekaHexarch extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_98_E',
            'asset'  => 'ALT_DUSTER_B_LY_98_E',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_EXALTED,
    	'name'  => clienttranslate("Phoibos, Reka Hexarch"),
      'typeline' => clienttranslate("Character - Artist Noble"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"I\'m never more comfortable than when I\'m in the spotlight."'),
      'artist' => "Gamon Studio",
			'extension'=>'SDU',
   'subtypes'  => [ARTIST,NOBLE],
 				'effectDesc' => clienttranslate('{H} Target opponent reveals a random card from their hand. If I\'m <IN_CONTACT>, you may immediately play it for free and it gains <FLEETING>. If you don\'t, discard it.'),
     'forest' => 6, 
     'mountain' => 3, 
     'ocean' => 6, 
     'costHand' => 7, 
     'costReserve' => 4, 
];
  }
}
