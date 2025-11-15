<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_TimeOut extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_95_C',
            'asset'  => 'ALT_DUSTER_B_YZ_95_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Time Out!"),
      'typeline' => clienttranslate("Spell - Disruption Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('Time to switch things up a bit.'),
      'artist' => "Gamon Studio",
			'extension'=>'SDU',
   'subtypes'  => [DISRUPTION,MANEUVER],
 				'effectDesc' => clienttranslate('<FLEETING>.  Send to Reserve target Character with Base Cost {4} or less, then exhaust it ({T}). (Its Base Cost is the Reserve Cost if Fleeting, or the Hand Cost if not.)'),
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
