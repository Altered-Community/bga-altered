<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_PushBacktheNight extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_121_R1',
            'asset'  => 'ALT_EOLE_B_YZ_121_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Push Back the Night"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Draw a card, #then discard a card from your hand.#  At Noon — If six or more cards are in your discard pile, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: When a card is discarded from your hand — You may exhaust me ({T}) to create a <MANA_MOTH> Illusion token in target Expedition.'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
