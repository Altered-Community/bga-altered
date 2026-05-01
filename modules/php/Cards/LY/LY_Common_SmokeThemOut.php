<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_SmokeThemOut extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_121_C',
            'asset'  => 'ALT_EOLE_B_LY_121_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Smoke Them Out"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} <RESUPPLY>.  When two {D} abilities are activated on one of your turns — Complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: {T} : The next time a {D} ability is activated this turn, target Character gains 1 boost.'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
