<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_TheFarm extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_62_C',
            'asset'  => 'ALT_BISE_B_MU_62_C',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("The Farm"),
            'typeline' => clienttranslate("Landmark_permanent - Construction"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('The Mess requires a farm that can consistently provide for its day-to-day needs.'),
            'artist' => "Khoa Viet",
			'extension'=>'WFTM',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('At Noon — I gain 1 Food counter per Character you control.  {T}, Spend 2 of my Food counters: $<RESUPPLY_LOW>.'),
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
