<?php
namespace ALT\Cards\LY;

class LY_Rare_IceboundTaiga extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_45_R2',
            'asset'  => 'ALT_ALIZE_B_MU_45_R2',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Icebound Taiga"),
            'typeline' => clienttranslate("Landmark_permanent - Site"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('We can sense it in the woodland silences, like a tremor.'),
            'artist' => "Max Fiévé",
			'extension'=>'TBF',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('When you play a Character in {V} — I gain a Trial counter.  When I gain my third Trial counter — Sacrifice me. If you do, create a <DRAGON_SHADE> Illusion token in target Expedition, then it gains <ANCHORED>.'),
     'costHand' => 3, 
     'costReserve' => 2, 
     'changedStats' => ['costReserve'], 
];
  }
}
