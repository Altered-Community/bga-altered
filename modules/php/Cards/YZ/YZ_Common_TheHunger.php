<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_TheHunger extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_56_C',
            'asset'  => 'ALT_BISE_B_YZ_56_C',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("The Hunger"),
            'typeline' => clienttranslate("Character - Spirit"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('The City has a soul, and it is famished.'),
            'artist' => "Taras Susak",
			'extension'=>'WFTM',
   'subtypes'  => [SPIRIT],
 				'effectDesc' => clienttranslate('{H} Discard all other cards in play or in Reserve.  When a card goes to the discard pile — I gain 1 boost.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 9, 
     'costReserve' => 3, 
];
  }
}
