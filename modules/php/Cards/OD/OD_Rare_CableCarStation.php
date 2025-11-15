<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_CableCarStation extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_102_R2',
            'asset'  => 'ALT_DUSTER_B_LY_102_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Cable-Car Station"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('Reka cable-cars are the safest way to get around the city.'),
      'artist' => "Anh Tung",
			'extension'=>'SDU',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('{J} #Draw a card,# then I gain 2 Move counters.  {T}, Spend 1 of my Move counters: One of your Expeditions moves backwards one region. If it does, your other Expedition moves forward one region.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
