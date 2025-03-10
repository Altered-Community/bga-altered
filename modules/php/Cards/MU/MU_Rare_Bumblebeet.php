<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_Bumblebeet extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_50_R1',
            'asset'  => 'ALT_BISE_B_MU_50_R',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Bumblebeet"),
            'typeline' => clienttranslate("Character - Plant Animal"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('On the surface, pollination by bumblebeets is a key tool in growing Muna crops.'),
            'artist' => "Ba Vo",
			'extension'=>'WFTM',
   'subtypes'  => [PLANT,ANIMAL],
 				'effectDesc' => clienttranslate('#{R} I gain <ANCHORED>.#'),
 				'supportDesc' => clienttranslate('{I} At Noon — I gain 1 boost, up to a max of 2.'),
 			     'supportIcon' => 'infinity',
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 3, 
     'changedStats' => ['costReserve'], 
];
  }
}
