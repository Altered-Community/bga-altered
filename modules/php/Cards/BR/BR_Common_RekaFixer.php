<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_RekaFixer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_115_C',
            'asset'  => 'ALT_EOLE_B_BR_115_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Reka Fixer"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Andy Jauffrit",
			'extension'=>'ROC',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('{R} If you control a Feat, <RESUPPLY_LOW>. (Put the top card of your deck in Reserve.)'),
 				'supportDesc' => clienttranslate('{D} : The next Character you play this turn gains 1 boost.'),
 			     'supportIcon' => 'discard',
     'forest' => 0, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 3, 
     'effectReserve' => FT::ACTION(CHECK_CONDITION, [
      'condition' => 'hasControl:feat:1',
      'effect' => FT::ACTION(RESUPPLY, []),
    ]),
     'effectSupport' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1Boost']),
];
  }
}
