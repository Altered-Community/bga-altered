<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_TheLastStand extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_118_R1',
            'asset'  => 'ALT_EOLE_B_BR_118_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("The Last Stand"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Taras Susak",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Send to Reserve target Character with Base Cost #{2} or less.#  When you pass — If you control another Feat, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: Your Landmarks limit is four.'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
