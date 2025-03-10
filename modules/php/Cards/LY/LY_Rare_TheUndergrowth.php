<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_TheUndergrowth extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_63_R2',
            'asset'  => 'ALT_BISE_B_MU_63_R',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("The Undergrowth"),
            'typeline' => clienttranslate("Landmark_permanent - Site"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Nature always reclaims its rights.'),
            'artist' => "Ba Vo",
			'extension'=>'WFTM',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('{T} : The next Character you play in {V} this turn gains 1 boost.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
