<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Exalted_HoldtheLine extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_122_E',
            'asset'  => 'ALT_EOLE_B_BR_122_E',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_EXALTED,
    	'name'  => clienttranslate("Hold the Line!"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung & Ba Vo",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Target Character gains 2 boosts.  When you pass — If you control two or more <BOOSTED_CHA_P> Characters, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: When a Companion joins your Expeditions — It gains 1 boost.'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
