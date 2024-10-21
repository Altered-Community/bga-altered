<?php
namespace ALT\Cards\AX;

class AX_Common_Avalanche extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_42_C',
            'asset'  => 'ALT_ALIZE_B_AX_42_C',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Avalanche"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('None of the snowflakes feel personally guilty for the avalanche.'),
            'artist' => "Jean-Baptiste Andrier",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('$<FLEETING>.  Send to Reserve any number of target Characters with total {M} of 4 or less.'),
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
