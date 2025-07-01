<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_AerolithReef extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_77_C',
            'asset'  => 'ALT_CYCLONE_B_AX_77_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Aerolith Reef"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('Reaching the pillar is no easy journey, as the clouds conceal countless reefs and other dangers.'),
      'artist' => "Khoa Viet",
			'extension'=>'SO',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('{J} You may send to Reserve target Character with Hand Cost {2} or less.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
