<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_TheLectern extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_100_C',
            'asset'  => 'ALT_DUSTER_B_OR_100_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("The Lectern"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('Sol may have sounded the alarm, but her words seem to be falling on deaf ears.'),
      'artist' => "Ba Vo",
			'extension'=>'SDU',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('{J} $<RESUPPLY>.  When I\'m sacrificed — Create an <ORDIS_RECRUIT> in a Hero Expedition. (Excess Landmarks are sacrificed at the end of the Day.)'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
