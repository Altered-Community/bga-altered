<?php
namespace ALT\Cards\AX;

class AX_Rare_IceboundPass extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_46_R2',
            'asset'  => 'ALT_ALIZE_B_YZ_46_R2',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Icebound Pass"),
            'typeline' => clienttranslate("Landmark_permanent - Site"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('We can hear it roar in the snowy passes.'),
            'artist' => "Justice Wong",
			'extension'=>'TBF',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('When you exhaust a card in Reserve — I gain a Trial counter.  When I gain my third Trial counter — Sacrifice me. If you do, create a <DRAGON_SHADE> Illusion token in target Expedition, then draw a card.'),
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
