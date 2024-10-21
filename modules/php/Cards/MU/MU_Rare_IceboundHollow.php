<?php
namespace ALT\Cards\MU;

class MU_Rare_IceboundHollow extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_46_R2',
            'asset'  => 'ALT_ALIZE_B_AX_46_R2',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Icebound Hollow"),
            'typeline' => clienttranslate("Landmark_permanent - Site"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('In the caves and crevices, it wails and calls to us.'),
            'artist' => "Kevin Sidharta",
			'extension'=>'TBF',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('When a card goes from your Hand or deck to Reserve — I gain a Trial counter.  When I gain my third Trial counter — Sacrifice me. If you do, create a <DRAGON_SHADE> Illusion token in target Expedition, then ready your cards in Reserve.'),
     'costHand' => 3, 
     'costReserve' => 2, 
     'changedStats' => ['costReserve'], 
];
  }
}
