<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_SpryScout extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_109_C',
            'asset'  => 'ALT_EOLE_B_BR_109_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Spry Scout"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Kevin Sidharta",
			'extension'=>'ROC',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('{R} If you control a Feat, I gain 1 boost.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'effectReserve' => FT::ACTION(CHECK_CONDITION, [
      'condition' => 'hasControl:feat:1',
      'effect' => FT::GAIN(ME, BOOST),
    ]),
];
  }
}
