<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_Dapeng extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_95_R1',
            'asset'  => 'ALT_DUSTER_B_MU_95_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Dapeng"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('With Turuun on its back, it carries a branch of the Spindle Tree in its beak.'),
      'artist' => "Matteo Spirito",
			'extension'=>'SDU',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('#$<TOUGH_1>.#'),
 				'supportDesc' => clienttranslate('{D} : Each player draws a card.'),
 			     'supportIcon' => 'discard',
     'forest' => 4, 
     'mountain' => 3, 
     'ocean' => 4, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['costHand'], 
 		'tough'=>1,
];
  }
}
