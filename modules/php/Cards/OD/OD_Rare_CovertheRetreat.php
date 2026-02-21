<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_CovertheRetreat extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_121_R1',
            'asset'  => 'ALT_EOLE_B_OR_121_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Cover the Retreat"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Kevin Sidharta",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Create two <ORDIS_RECRUIT> Soldier tokens #distributed among any Expeditions.#  When you pass — If #six# or more Characters are in your Expeditions, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: When you create a token Character — You may exhaust me ({T}) to give it 1 boost. '),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
