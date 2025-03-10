<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_Evanescence extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_58_R2',
            'asset'  => 'ALT_BISE_B_YZ_58_R',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Evanescence"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('In the depths of the City, something seems to be devouring memories and thoughts.'),
            'artist' => "Justice Wong",
			'extension'=>'WFTM',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('#Do the following X+1 times,# where X is my number of Arcane counters:  • Send to Reserve target Character with #Hand Cost {2} or less#, then exhaust it ({T}). (Exhausted cards can\'t be played and have no Support abilities.)'),
 				'supportDesc' => clienttranslate('{I} #At Noon — Choose one:#  • I gain 1 Arcane counter, up to a max of 3.  • #{T} : I gain 2 Arcane counters, up to a max of 3.#'),
 			     'supportIcon' => 'infinity',
     'costHand' => 2, 
     'costReserve' => 4, 
];
  }
}
