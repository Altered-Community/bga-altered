<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_Thunderbird extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_110_C',
            'asset'  => 'ALT_EOLE_B_OR_110_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Thunderbird"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "DOBA",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} My Expedition <ASCENDS>.  When my Expedition moves forward <DUE_TO_ASCENSION> (if it moved forward due to at least one matched stat) — Draw a card.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
