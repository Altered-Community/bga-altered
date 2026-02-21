<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_StrategicDeployment extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_118_R1',
            'asset'  => 'ALT_EOLE_B_OR_118_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Strategic Deployment"),
      'typeline' => clienttranslate("Spell - Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "DOBA",
			'extension'=>'ROC',
   'subtypes'  => [MANEUVER],
 				'effectDesc' => clienttranslate('Choose one:  • Target up to two Expeditions and create an <ORDIS_RECRUIT> Soldier token in each of them.  • Target Character with Base Cost {2} or less switches Expeditions.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
