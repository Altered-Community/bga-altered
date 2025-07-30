<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_CountingSheep extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_MU_80_C',
            'asset'  => 'ALT_CYCLONE_B_MU_80_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Counting Sheep"),
      'typeline' => clienttranslate("Spell - Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('The deepest sleep is woven from the wool of sweet dreams.'),
      'artist' => "HuoMiao Studio",
			'extension'=>'SO',
   'subtypes'  => [MANEUVER],
 				'effectDesc' => clienttranslate('<FLEETING>.  Target two Expeditions and create a <WOOLLYBACK> Animal token in each one. Then, each Character with Hand Cost {1} or less gains <ASLEEP>. (During Dusk, ignore their statistics. During Rest, they don\'t go to Reserve and lose Asleep.)'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
