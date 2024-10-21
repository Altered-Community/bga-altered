<?php
namespace ALT\Cards\LY;

class LY_Common_WillotheWisp extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_35_C',
            'asset'  => 'ALT_ALIZE_B_LY_35_C',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Will-o'-the-Wisp"),
            'typeline' => clienttranslate("Character - Spirit"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('"Nine fathom deep he had followed us - From the land of mist and snow."'),
            'artist' => "Khoa Viet",
			'extension'=>'TBF',
   'subtypes'  => [SPIRIT],
 				'effectDesc' => clienttranslate('If the Expedition facing me is in {O}, it can only move forward due to {O}.'),
 				'supportDesc' => clienttranslate('{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)'),
 			     'supportIcon' => 'discard',
     'forest' => 0, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
