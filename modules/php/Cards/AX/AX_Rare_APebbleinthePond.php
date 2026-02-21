<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_APebbleinthePond extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_119_R1',
            'asset'  => 'ALT_EOLE_B_AX_119_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("A Pebble in the Pond"),
      'typeline' => clienttranslate("Spell - Boon"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'ROC',
   'subtypes'  => [BOON],
 				'effectDesc' => clienttranslate('#Play me for {1} less if there are no tokens in your Landmarks.#  Create an <AEROLITH> token in your Landmarks.'),
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costReserve'], 
     'dynamicCostReduction' => '1:hasNoTokensInLandmarks',
     'effectPlayed' => [
      'action' => INVOKE_TOKEN,
      'automatic' => true,
      'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]],
    ],
];
  }
}
