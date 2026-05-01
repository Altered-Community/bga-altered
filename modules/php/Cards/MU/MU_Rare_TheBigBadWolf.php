<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_TheBigBadWolf extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_120_R1',
            'asset'  => 'ALT_EOLE_B_MU_120_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("The Big Bad Wolf"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} <SABOTAGE> a Character with {V} less than or equal to mine.'),
 				'supportDesc' => clienttranslate('#{D} : The next Character with Base Cost {3} or less you play this turn gains <ANCHORED>.#'),
 			     'supportIcon' => 'discard',
     'forest' => 3, 
     'mountain' => 2, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
