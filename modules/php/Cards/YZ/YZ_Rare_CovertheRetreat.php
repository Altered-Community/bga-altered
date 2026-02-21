<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_CovertheRetreat extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_121_R2',
            'asset'  => 'ALT_EOLE_B_OR_121_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Cover the Retreat"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Kevin Sidharta",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Create a #<MANA_MOTH> Illusion# token in each of your Expeditions.  #At Noon# — If #six or more cards are in your discard pile,# complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: When you create a token Character — You may exhaust me ({T}) to give it 1 boost. '),
 			     'supportIcon' => 'discard',
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
