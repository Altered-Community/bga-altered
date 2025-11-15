<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_RomanticEncounter extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_100_C',
            'asset'  => 'ALT_DUSTER_B_LY_100_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Romantic Encounter"),
      'typeline' => clienttranslate("Spell - Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('"I\'ve never felt this close to anyone."'),
      'artist' => "Zero Wen",
			'extension'=>'SDU',
   'subtypes'  => [MANEUVER],
 				'effectDesc' => clienttranslate('Target opponent reveals the top four cards of their deck. You may play a Character from these cards for free and it gains <FLEETING>, then discard the rest. (Don\'t activate any {h} abilities.)'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
