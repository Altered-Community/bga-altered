<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_BestowingSloth extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_113_C',
            'asset'  => 'ALT_EOLE_B_LY_113_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Bestowing Sloth"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} I gain $<ASLEEP>.'),
 				'supportDesc' => clienttranslate('{D} : <AFTER_YOU>. (End your turn as if you had played a card.)'),
 			     'supportIcon' => 'discard',
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 3, 
];
  }
}
