<?php
namespace ALT\Cards\LY;

class LY_Common_TheMagicSleigh extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_44_C',
            'asset'  => 'ALT_ALIZE_B_LY_44_C',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("The Magic Sleigh"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Here to sleigh!'),
            'artist' => "Khoa Viet",
			'extension'=>'TBF',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('If my Expedition would move forward during Dusk, it moves twice instead.'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
