<?php
namespace ALT\Cards\AX;

class AX_Rare_FrozenReprocessor extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_45_R1',
            'asset'  => 'ALT_ALIZE_B_AX_45_R',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Frozen Reprocessor"),
            'typeline' => clienttranslate("Landmark_permanent - Construction"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Nothing is created, nothing is lost... even to the frost.'),
            'artist' => "Romain Kurdi",
			'extension'=>'TBF',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('#{J} $<EXHAUSTED_RESUPPLY>.#  At Noon — <EXHAUSTED_RESUPPLY>.  You may keep one more card in Reserve during Night if it\'s exhausted.'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
