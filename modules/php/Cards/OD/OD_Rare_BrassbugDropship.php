<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_BrassbugDropship extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_80_R2',
            'asset'  => 'ALT_CYCLONE_B_AX_80_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Brassbug Dropship"),
      'typeline' => clienttranslate("Landmark_permanent - Construction"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('"Those little pests are tough. Even three miles up, they still manage to follow us." - Subhash'),
      'artist' => "Kevin Sidharta",
			'extension'=>'SO',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('When I\'m sacrificed — Create a <BRASSBUG> Robot token in each of your Expeditions. (Excess Landmarks are sacrificed at the end of the Day.)'),
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
