<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_TheMinotaur extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_58_R2',
            'asset'  => 'ALT_BISE_B_MU_58_R',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("The Minotaur"),
            'typeline' => clienttranslate("Character - Animal Druid"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('As strong as an old oak with roots branching out beneath the ground.'),
            'artist' => "Matteo Spirito",
			'extension'=>'WFTM',
   'subtypes'  => [ANIMAL,DRUID],
 				'effectDesc' => clienttranslate('$<SCOUT_3> {3}.  {J} #Target Character# gains <ANCHORED>.'),
 				'supportDesc' => clienttranslate('{I} #When you play a Character with a base statistic of 0 — I gain 1 boost, up to a max of 2.#'),
 			     'supportIcon' => 'infinity',
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 6, 
     'costReserve' => 6, 
 		'scout' => 99,
];
  }
}
