<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_Nike extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_76_R2',
            'asset'  => 'ALT_CYCLONE_B_OR_76_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Nike"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('When she spreads her wings, her victory shall resonate for all eternity.'),
      'artist' => "Aaron Ming",
			'extension'=>'SO',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('$<ETERNAL_FS>.  At Noon — Target Expedition <ASCENDS>.'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 7, 
     'costReserve' => 7, 
     'changedStats' => ['forest','mountain','ocean'], 
];
  }
}
