<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_BLISSBassist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_49_C',
            'asset'  => 'ALT_BISE_B_LY_49_C',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("BLISS Bassist"),
            'typeline' => clienttranslate("Character - Artist"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('"This one\'s for all the explorers out there and all the hard work they do. They\'re not just monkeyin\' around!" — Boona'),
            'artist' => "Zero Wen",
			'extension'=>'WFTM',
   'subtypes'  => [ARTIST],
 				'supportDesc' => clienttranslate('{I} When you play another Character with a base statistic of 0 — I gain 1 boost, up to a max of 2.'),
 			     'supportIcon' => 'infinity',
     'forest' => 0, 
     'mountain' => 0, 
     'ocean' => 2, 
     'costHand' => 1, 
     'costReserve' => 2, 
];
  }
}
