<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_Nike extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_76_C',
            'asset'  => 'ALT_CYCLONE_B_OR_76_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Nike"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('When she spreads her wings, her victory shall resonate for all eternity.'),
      'artist' => "Aaron Ming",
			'extension'=>'SO',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('$<ETERNAL_FS>.  At Noon — Target Expedition <ASCENDS>. (Until Rest, it can move forward even if matched in its region\'s terrains by the opponent\'s Expedition.)'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 7, 
     'costReserve' => 7, 
];
  }
}
