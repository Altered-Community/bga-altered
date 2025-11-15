<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_AngryCrowd extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_99_C',
            'asset'  => 'ALT_DUSTER_B_OR_99_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Angry Crowd"),
      'typeline' => clienttranslate("Spell - Disruption Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('Anger is often the fruit of frustration.'),
      'artist' => "Justice Wong",
			'extension'=>'SDU',
   'subtypes'  => [DISRUPTION,MANEUVER],
 				'effectDesc' => clienttranslate('$<FLEETING>.  Discard target Character or Permanent, then create a <MANASEED> token in your Landmarks.'),
     'costHand' => 5, 
     'costReserve' => 5, 
];
  }
}
