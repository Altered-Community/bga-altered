<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_AerolithReef extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_77_R1',
            'asset'  => 'ALT_CYCLONE_B_AX_77_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Aerolith Reef"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('Reaching the pillar is no easy journey, as the clouds conceal countless reefs and other dangers.'),
      'artist' => "Khoa Viet",
			'extension'=>'SO',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('{J} You may send to Reserve target Character with Hand Cost {2} or less.  #When I\'m sacrificed — <RESUPPLY>.  {T}, {1} : Sacrifice me.#'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
