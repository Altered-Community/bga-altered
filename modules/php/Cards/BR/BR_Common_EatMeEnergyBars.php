<?php
namespace ALT\Cards\BR;

class BR_Common_EatMeEnergyBars extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_45_C',
            'asset'  => 'ALT_ALIZE_B_BR_45_C',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Eat Me Energy Bars"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Too good to share.'),
            'artist' => "Kevin Sidharta",
			'extension'=>'TBF',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('If there is only one Character in my Expedition, it is <GIGANTIC>. (It is considered present in each of your Expeditions.)'),
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
