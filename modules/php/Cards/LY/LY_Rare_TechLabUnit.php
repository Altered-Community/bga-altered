<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_TechLabUnit extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_61_R2',
            'asset'  => 'ALT_BISE_B_AX_61_R',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Tech Lab Unit"),
            'typeline' => clienttranslate("Landmark_permanent - Construction"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Two\'s company, three\'s a crowd.'),
            'artist' => "Justice Wong",
			'extension'=>'WFTM',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('{J} <RESUPPLY>.  Your Reserve limit is increased by one.'),
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
