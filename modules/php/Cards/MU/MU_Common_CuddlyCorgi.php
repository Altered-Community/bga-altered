<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_CuddlyCorgi extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_52_C',
            'asset'  => 'ALT_BISE_B_MU_52_C',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Cuddly Corgi"),
            'typeline' => clienttranslate("Character - Animal"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('She hunts mercilessly for treats and snuggles.'),
            'artist' => "Zael",
			'extension'=>'WFTM',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('When a Character you control gains <ANCHORED> — I gain 1 boost.'),
     'forest' => 2, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
