<?php
namespace ALT\Cards\MU;

class MU_Common_FloralTent extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_44_C',
            'asset'  => 'ALT_ALIZE_B_MU_44_C',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Floral Tent"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('A beautiful shelter from the raging elements outside.'),
            'artist' => "Zael",
			'extension'=>'TBF',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('{J} $<RESUPPLY>.  If an <ANCHORED> Character would leave my Expedition during the Afternoon, it loses <ANCHORED> instead.'),
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
