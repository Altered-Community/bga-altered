<?php
namespace ALT\Cards\OD;

class OD_Common_IceboundLake extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_47_C',
            'asset'  => 'ALT_ALIZE_B_OR_47_C',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Icebound Lake"),
            'typeline' => clienttranslate("Landmark_permanent - Site"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('With a voice like thunder or crackling ice it howls.'),
            'artist' => "Nestor Papatriantafyllou",
			'extension'=>'TBF',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('When a non-token Character joins one of your Expeditions, if it\'s behind — I gain a Trial counter.  When I gain my third Trial counter — Sacrifice me. If you do, create a <DRAGON_SHADE> Illusion token in target Expedition, then target Character gains <ASLEEP>.'),
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
