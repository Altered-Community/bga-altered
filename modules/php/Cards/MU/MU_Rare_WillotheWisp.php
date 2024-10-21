<?php
namespace ALT\Cards\MU;

class MU_Rare_WillotheWisp extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_35_R2',
            'asset'  => 'ALT_ALIZE_B_LY_35_R2',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Will-o'-the-Wisp"),
            'typeline' => clienttranslate("Character - Spirit"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('"Nine fathom deep he had followed us - From the land of mist and snow."'),
            'artist' => "Khoa Viet",
			'extension'=>'TBF',
   'subtypes'  => [SPIRIT],
 				'effectDesc' => clienttranslate('If the Expedition facing me is in #{V}#, it can only move forward due to #{V}#.'),
 				'supportDesc' => clienttranslate('{D} : The next card you play this turn costs {1} less. (Discard me from Reserve to do this.)'),
 			     'supportIcon' => 'discard',
     'forest' => 3, 
     'mountain' => 0, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 2, 
     'changedStats' => ['forest'], 
];
  }
}
