<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_OutofaDarkSky extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_120_C',
            'asset'  => 'ALT_EOLE_B_OR_120_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Out of a Dark Sky"),
      'typeline' => clienttranslate("Spell - Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
			'extension'=>'ROC',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  Send to Reserve target Character with Base Cost {3} or less. Then, if both of your Expeditions are <ASCENDED_P>, <RESUPPLY_LOW>.'),
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
