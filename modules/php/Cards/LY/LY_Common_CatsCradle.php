<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_CatsCradle extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_120_C',
            'asset'  => 'ALT_EOLE_B_LY_120_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Cat's Cradle"),
      'typeline' => clienttranslate("Spell - Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
			'extension'=>'ROC',
   'subtypes'  => [MANEUVER],
 				'effectDesc' => clienttranslate('Target Character with Base Cost {3} or less switches Expeditions, then gains <ANCHORED>. (Switch means joining the other Expedition of its controller.)'),
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
