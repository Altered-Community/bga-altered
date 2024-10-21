<?php
namespace ALT\Cards\MU;

class MU_Rare_WinterOutfits extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_43_R2',
            'asset'  => 'ALT_ALIZE_B_LY_43_R2',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Winter Outfits"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('There\'s no such thing as bad weather, only bad clothing.'),
            'artist' => "Fahmi Fauzi",
			'extension'=>'TBF',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('#{R} I lose <FLEETING>.#  Characters in my Expedition have their {V}, {M}, and {O} equal to their highest statistic.'),
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
