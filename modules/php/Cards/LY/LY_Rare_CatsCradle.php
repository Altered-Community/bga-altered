<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_CatsCradle extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_120_R1',
            'asset'  => 'ALT_EOLE_B_LY_120_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Cat's Cradle"),
      'typeline' => clienttranslate("Spell - Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
			'extension'=>'ROC',
   'subtypes'  => [MANEUVER],
 				'effectDesc' => clienttranslate('Target Character with Base Cost #{2} or less# switches Expeditions, then gains <ANCHORED>.'),
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand'], 
];
  }
}
