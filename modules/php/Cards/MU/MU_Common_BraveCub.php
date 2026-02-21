<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_BraveCub extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_107_C',
            'asset'  => 'ALT_EOLE_B_MU_107_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Brave Cub"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'supportDesc' => clienttranslate('{D} : Discard target non-Companion token.'),
 			     'supportIcon' => 'discard',
     'forest' => 1, 
     'mountain' => 3, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
