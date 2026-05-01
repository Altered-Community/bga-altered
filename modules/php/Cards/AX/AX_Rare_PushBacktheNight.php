<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_PushBacktheNight extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_121_R2',
            'asset'  => 'ALT_EOLE_B_YZ_121_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Push Back the Night"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Draw a card, #then put a card from your hand in Reserve.#  At Noon — If six or more cards are in your discard pile, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: When #a card goes directly from your hand to Reserve# — You may exhaust me ({T}) to create a #<BRASSBUG> Robot# token in target Expedition.'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
