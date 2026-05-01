<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_BraveCub extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_107_R1',
            'asset'  => 'ALT_EOLE_B_MU_107_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Brave Cub"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('#{H} You may discard target non-Companion token.#'),
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
