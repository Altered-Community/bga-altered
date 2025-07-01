<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_Bait extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_81_C',
            'asset'  => 'ALT_CYCLONE_B_YZ_81_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Bait"),
      'typeline' => clienttranslate("Spell - Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('They always say the grass is greener on the other side...'),
      'artist' => "Kevin Sidharta",
			'extension'=>'SO',
   'subtypes'  => [MANEUVER],
 				'effectDesc' => clienttranslate('$<FLEETING>.  Target token Character defects. (It joins the Expedition facing it, changing controllers.)'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
