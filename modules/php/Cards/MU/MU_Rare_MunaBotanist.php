<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_MunaBotanist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_88_R1',
            'asset'  => 'ALT_DUSTER_B_MU_88_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Muna Botanist"),
      'typeline' => clienttranslate("Character - Druid"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('If the Juice gives life, then it must take it from somewhere.'),
      'artist' => "Matteo Spirito",
			'extension'=>'SDU',
   'subtypes'  => [DRUID],
 				'effectDesc' => clienttranslate('{H} Target opponent #<EXHAUSTED_RESUPPLIES>.#  {H} You may target another Character with Base Cost {3} or less, it gains <ANCHORED>. (Its Base Cost is its Reserve Cost if it\'s Fleeting, or its Hand Cost if not.)'),
     'forest' => 2, 
     'mountain' => 1, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 1, 
     'changedStats' => ['mountain','costReserve'], 
];
  }
}
