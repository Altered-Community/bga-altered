<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_RunningwiththeWolves extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_119_C',
            'asset'  => 'ALT_EOLE_B_MU_119_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Running with the Wolves"),
      'typeline' => clienttranslate("Spell - Song Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "DOBA",
			'extension'=>'ROC',
   'subtypes'  => [SONG,MANEUVER],
 				'effectDesc' => clienttranslate('<FLEETING>.  Reveal the top five cards of your deck. Choose Animals from them with total Hand Cost {7} or less and play them for free. (Don\'t activate their {h} abilities.) Discard the rest.'),
     'costHand' => 6, 
     'costReserve' => 6, 
];
  }
}
