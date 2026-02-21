<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_RunningwiththeWolves extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_119_R2',
            'asset'  => 'ALT_EOLE_B_MU_119_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Running with the Wolves"),
      'typeline' => clienttranslate("Spell - Song Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "DOBA",
			'extension'=>'ROC',
   'subtypes'  => [SONG,MANEUVER],
 				'effectDesc' => clienttranslate('<FLEETING>.  Reveal the top five cards of your deck. Choose Animals #and Artists# from them with total Hand Cost {7} or less and play them for free #as if from hand.# Discard the rest.'),
     'costHand' => 6, 
     'costReserve' => 6, 
];
  }
}
