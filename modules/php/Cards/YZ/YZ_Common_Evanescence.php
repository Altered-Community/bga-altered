<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_Evanescence extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_58_C',
            'asset'  => 'ALT_BISE_B_YZ_58_C',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Evanescence"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('In the depths of the City, something seems to be devouring memories and thoughts.'),
            'artist' => "Justice Wong",
			'extension'=>'WFTM',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('Send to Reserve target Character with Hand Cost {X}+{2} or less, where X is my number of Arcane Counters, then exhaust it ({T}). (Exhausted cards can\'t be played and have no Support abilities.)'),
 				'supportDesc' => clienttranslate('{I} When you play another Spell — I gain 1 Arcane counter, up to a max of 3.'),
 			     'supportIcon' => 'infinity',
     'costHand' => 2, 
     'costReserve' => 4, 
];
  }
}
