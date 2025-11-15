<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_TechnologicalEncounter extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_98_R1',
            'asset'  => 'ALT_DUSTER_B_AX_98_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Technological Encounter"),
      'typeline' => clienttranslate("Spell - Conjuration Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('"The fruit of our research will lead our peoples to new heights."'),
      'artist' => "DOBA",
			'extension'=>'SDU',
   'subtypes'  => [CONJURATION,MANEUVER],
 				'effectDesc' => clienttranslate('<COOLDOWN>.  Draw a card, then create a <MANASEED> token in your Landmarks.'),
     'costHand' => 3, 
     'costReserve' => 2, 
     'changedStats' => ['costHand'], 
 		'cooldown' => true,
];
  }
}
