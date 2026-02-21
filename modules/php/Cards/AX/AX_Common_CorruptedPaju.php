<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_CorruptedPaju extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_108_C',
            'asset'  => 'ALT_EOLE_B_AX_108_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Corrupted Paju"),
      'typeline' => clienttranslate("Character - Adventurer Corruption"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
			'extension'=>'ROC',
   'subtypes'  => [ADVENTURER,CORRUPTION],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless your hand is empty.  {R} Create an <AEROLITH> token in your Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'effectHand' => FT::ACTION(CHECK_CONDITION, [
      'condition' => 'isHandEmpty',
      'effect' => null,
      'oppositeOutput' => FT::GAIN(ME, FLEETING),
    ]),
     'effectReserve' => [
      'action' => INVOKE_TOKEN,
      'automatic' => true,
      'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]],
    ],
];
  }
}
