<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_SmokeThemOut extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_121_R2',
            'asset'  => 'ALT_EOLE_B_LY_121_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Smoke Them Out"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} #Draw a card, then put a card from your hand in Reserve.#  When #three {T} abilities# are activated on one of your turns — Complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: {T} : The next time a #{T} ability# is activated this turn, target Character #in play or in Reserve# gains 1 boost.'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
