<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_Cleanse extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_118_R1',
            'asset'  => 'ALT_EOLE_B_LY_118_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Cleanse"),
      'typeline' => clienttranslate("Spell - Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Victor Canton",
			'extension'=>'ROC',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('Roll a die. #On a 1-3, I gain <FLEETING>.# Then, you may send to Reserve target Character with Base Cost {X} or less, where X is the result.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
