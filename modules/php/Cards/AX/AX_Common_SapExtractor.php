<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_SapExtractor extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_60_C',
            'asset'  => 'ALT_BISE_B_AX_60_C',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Sap Extractor"),
            'typeline' => clienttranslate("Landmark_permanent - Construction"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('The Sap courses through the whole city like blood in a mortal\'s veins.'),
            'artist' => "Jean-Baptiste Andrier",
			'extension'=>'WFTM',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('At Noon — You may <AUGMENT> target card in play or in Reserve. (If it has counters, it gains 1 more. This can\'t target Hero cards.)'),
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
