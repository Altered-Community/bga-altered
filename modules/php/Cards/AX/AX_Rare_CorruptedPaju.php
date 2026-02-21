<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_CorruptedPaju extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_108_R1',
            'asset'  => 'ALT_EOLE_B_AX_108_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Corrupted Paju"),
      'typeline' => clienttranslate("Character - Adventurer Corruption"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
			'extension'=>'ROC',
   'subtypes'  => [ADVENTURER,CORRUPTION],
 				'effectDesc' => clienttranslate('#I can\'t be played# if there\'s another card in your hand.  #{J}# Create an <AEROLITH> token in your Landmarks.'),
 				'supportDesc' => clienttranslate('#{D} : Create an <AEROLITH> token in target player\'s Landmarks.#'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['ocean'], 
     'playLimitation' => 'singleCardHand',
     'effectPlayed' => [
      'action' => INVOKE_TOKEN,
      'automatic' => true,
      'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]],
    ],
     'effectSupport' =>  [
      'action' => INVOKE_TOKEN,
      'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK], 'allPlayers' => true],
    ],
];
  }
}
