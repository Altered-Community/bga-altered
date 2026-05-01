<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Exalted_GiveFateaTwist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_122_E',
            'asset'  => 'ALT_EOLE_B_LY_122_E',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_EXALTED,
    	'name'  => clienttranslate("Give Fate a Twist!"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung & Ba Vo",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Roll a die. On a 1: Play another turn.  When you roll a 6+ on a die — Complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: If you would roll a die, you may exhaust me ({T}) to add 1 to its result. (Choose after you see the result.)'),
 			     'supportIcon' => 'discard',
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
