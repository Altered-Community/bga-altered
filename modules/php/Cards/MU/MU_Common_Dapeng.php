<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_Dapeng extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_95_C',
            'asset'  => 'ALT_DUSTER_B_MU_95_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Dapeng"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('With Turuun on its back, it carries a branch of the Spindle Tree in its beak.'),
      'artist' => "Matteo Spirito",
			'extension'=>'SDU',
   'subtypes'  => [ANIMAL],
 				'supportDesc' => clienttranslate('{D} : Each player draws a card. (Discard me from Reserve to do this.)'),
 			     'supportIcon' => 'discard',
     'forest' => 4, 
     'mountain' => 3, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 3, 
];
  }
}
