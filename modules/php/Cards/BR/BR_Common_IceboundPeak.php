<?php
namespace ALT\Cards\BR;

class BR_Common_IceboundPeak extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_46_C',
            'asset'  => 'ALT_ALIZE_B_BR_46_C',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Icebound Peak"),
            'typeline' => clienttranslate("Landmark_permanent - Site"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('On the summit it waits, for freedom, for release.'),
            'artist' => "Matteo Spirito",
			'extension'=>'TBF',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('When a Character you control gains <FLEETING_CHAR> — I gain a Trial counter.  When I gain my third Trial counter — Sacrifice me. If you do, create a <DRAGON_SHADE> Illusion token in target Expedition, then each Character you control gains 1 boost.'),
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
