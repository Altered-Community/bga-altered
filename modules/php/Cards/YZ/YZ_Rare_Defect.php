<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_Defect extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_77_R1',
            'asset'  => 'ALT_CYCLONE_B_YZ_77_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Defect"),
      'typeline' => clienttranslate("Spell - Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('Changing sides isn\'t always a matter of choice.'),
      'artist' => "Justice Wong",
			'extension'=>'SO',
   'subtypes'  => [MANEUVER],
 				'effectDesc' => clienttranslate('<FLEETING>.  Target Character #with Hand Cost {4} or less# defects. (It joins the Expedition facing it, changing controllers.)'),
     'costHand' => 6, 
     'costReserve' => 6, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
