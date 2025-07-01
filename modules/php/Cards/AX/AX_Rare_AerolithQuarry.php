<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_AerolithQuarry extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_82_R1',
            'asset'  => 'ALT_CYCLONE_B_AX_82_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Aerolith Quarry"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('"It took great feats of ingenuity to mine for resources at such altitude." - Isaree'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SO',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('At Noon — If your opponent is first player, create an <AEROLITH> token in your Landmarks.  #When you sacrifice a Permanent — You may exhaust me ({T}) to give target Character 1 boost.#'),
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
