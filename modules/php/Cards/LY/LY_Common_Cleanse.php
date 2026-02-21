<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_Cleanse extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_118_C',
            'asset'  => 'ALT_EOLE_B_LY_118_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Cleanse"),
      'typeline' => clienttranslate("Spell - Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Victor Canton",
			'extension'=>'ROC',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  Roll a die. You may send to Reserve target Character with Base Cost {X} or less, where X is the result. (Base Cost is the Reserve Cost if it\'s Fleeting, or the Hand Cost if not.)'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
