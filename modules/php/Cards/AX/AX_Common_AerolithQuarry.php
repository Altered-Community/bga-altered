<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_AerolithQuarry extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_82_C',
            'asset'  => 'ALT_CYCLONE_B_AX_82_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Aerolith Quarry"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('"It took great feats of ingenuity to mine for resources at such altitude." - Isaree'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SO',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('At Noon — If your opponent is first player, create an <AEROLITH> token in your Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
