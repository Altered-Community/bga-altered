<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_OutofaDarkSky extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_120_R1',
            'asset'  => 'ALT_EOLE_B_OR_120_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Out of a Dark Sky"),
      'typeline' => clienttranslate("Spell - Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
			'extension'=>'ROC',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  Send to Reserve target Character with Base Cost #{2} or less.# Then, if both of your Expeditions are <ASCENDED_P>, <RESUPPLY_LOW>.'),
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
