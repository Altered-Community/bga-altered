<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Exalted_SoundtheHowl extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_121_E',
            'asset'  => 'ALT_EOLE_B_MU_121_E',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_EXALTED,
    	'name'  => clienttranslate("Sound the Howl!"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung & Ba Vo",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Create a <WOOLLYBACK> Animal token in target Expedition. It gains <ANCHORED>.  When you pass — If three or more Animals in your Expeditions have a different {V} stat, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: {T} : The next Animal you play this turn gains 1 boost.'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
