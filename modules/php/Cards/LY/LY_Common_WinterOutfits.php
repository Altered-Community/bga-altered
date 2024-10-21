<?php
namespace ALT\Cards\LY;

class LY_Common_WinterOutfits extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_43_C',
            'asset'  => 'ALT_ALIZE_B_LY_43_C',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Winter Outfits"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('There\'s no such thing as bad weather, only bad clothing.'),
            'artist' => "Fahmi Fauzi",
			'extension'=>'TBF',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('Characters in my Expedition have their {V}, {M}, and {O} equal to their highest statistic.'),
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
