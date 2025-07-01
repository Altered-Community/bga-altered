<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_TheUglyDuckling extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_66_R1',
            'asset'  => 'ALT_CYCLONE_B_OR_66_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("The Ugly Duckling"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('This young recruit swans about while proudly showing off his insignia.'),
      'artist' => "Kevin Sidharta",
			'extension'=>'SO',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('#{J} You may pay {1}. If you do, I gain 1 boost and my Expedition <ASCENDS>.#'),
 				'supportDesc' => clienttranslate('{D} : Target Expedition <ASCENDS>.'),
 			     'supportIcon' => 'discard',
     'forest' => 1, 
     'mountain' => 0, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
