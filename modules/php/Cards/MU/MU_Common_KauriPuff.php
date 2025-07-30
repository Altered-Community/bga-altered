<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_KauriPuff extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_MU_65_C',
            'asset'  => 'ALT_CYCLONE_B_MU_65_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Kauri & Puff"),
      'typeline' => clienttranslate("Hero - 0"),
    	'type'  => HERO,
    	'flavorText'  => clienttranslate('The language of nature has no use for words'),
      'artist' => "Ba Vo",
			'extension'=>'SO',
   'subtypes'  => [0],
 				'effectDesc' => clienttranslate('At Noon — If you are first player, create a <WOOLLYBACK> Animal token in target opponent\'s Companion Expedition, then draw a card.'),
     'costHand' => 0, 
     'costReserve' => 0, 
];
  }
}
