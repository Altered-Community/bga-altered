<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_RomanticEncounter extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_100_R1',
            'asset'  => 'ALT_DUSTER_B_LY_100_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Romantic Encounter"),
      'typeline' => clienttranslate("Spell - Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('"I\'ve never felt this close to anyone."'),
      'artist' => "Zero Wen",
			'extension'=>'SDU',
   'subtypes'  => [MANEUVER],
 				'effectDesc' => clienttranslate('#<FLEETING>.#  #Do this for each player, starting with you:#  • That player reveals the top four cards of their deck. You may play a Character #with Base Cost {3} or less# from these cards for free and it gains <FLEETING>, then discard the rest.'),
     'costHand' => 7, 
     'costReserve' => 7, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
