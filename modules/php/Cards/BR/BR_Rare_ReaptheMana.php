<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_ReaptheMana extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_121_R1',
            'asset'  => 'ALT_EOLE_B_BR_121_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reap the Mana"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} You may put a card from your Reserve in your Mana zone, exhausted. #If you do, <RESUPPLY_LOW>.#  When you pass — If there are twelve or more Mana Orbs in your Mana zone, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: If one of your Expeditions would move forward during Dusk, you may exhaust me ({T}) to make it move forward one more region instead.'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
