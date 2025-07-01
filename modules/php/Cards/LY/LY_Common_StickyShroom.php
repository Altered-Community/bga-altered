<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_StickyShroom extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_67_C',
            'asset'  => 'ALT_CYCLONE_B_LY_67_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Sticky Shroom"),
      'typeline' => clienttranslate("Character - Plant"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('He\'s a fun guy, but he can get into some sticky situations.'),
      'artist' => "Khoa Viet",
			'extension'=>'SO',
   'subtypes'  => [PLANT],
 				'effectDesc' => clienttranslate('{J} I gain $<ANCHORED>.'),
     'forest' => 2, 
     'mountain' => 0, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
