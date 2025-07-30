<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_ThePainthouse extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_81_C',
            'asset'  => 'ALT_CYCLONE_B_LY_81_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("The Painthouse"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('The paints of the Tisdhera still perfume the heights of the Wayfarer.'),
      'artist' => "Tristan Bideau",
			'extension'=>'SO',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('{J} $<RESUPPLY>.  At Noon — If three or more single-terrain regions are visible, you may give 1 boost to target Character in Reserve.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
