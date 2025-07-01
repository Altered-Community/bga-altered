<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_Daikokuten extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_76_C',
            'asset'  => 'ALT_CYCLONE_B_LY_76_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Daikokuten"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('If you never take a risk, you\'ll never be rewarded.'),
      'artist' => "Zero Wen",
			'extension'=>'SO',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('{J} Target opponent may immediately play a Spell for free.'),
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
