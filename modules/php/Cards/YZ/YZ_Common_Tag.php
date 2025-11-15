<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_Tag extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_99_C',
            'asset'  => 'ALT_DUSTER_B_YZ_99_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Tag!"),
      'typeline' => clienttranslate("Spell - Disruption Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('"The Reka player is out!"'),
      'artist' => "Justice Wong",
			'extension'=>'SDU',
   'subtypes'  => [DISRUPTION,MANEUVER],
 				'effectDesc' => clienttranslate('<FLEETING>.  Target opponent sacrifices the Character they control with the highest Base Cost. (Its Base Cost is the Reserve Cost if Fleeting, or the Hand Cost if not.)'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
