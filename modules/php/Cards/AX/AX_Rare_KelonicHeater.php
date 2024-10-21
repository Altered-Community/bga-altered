<?php
namespace ALT\Cards\AX;

class AX_Rare_KelonicHeater extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_43_R1',
            'asset'  => 'ALT_ALIZE_B_AX_43_R',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Kelonic Heater"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('A bit of warmth goes a long way in brightening a cold day.'),
            'artist' => "Kevin Sidharta",
			'extension'=>'TBF',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('#{H}# $<EXHAUSTED_RESUPPLY>.  You may play exhausted Characters from your Reserve in my Expedition.'),
     'costHand' => 3, 
     'costReserve' => 1, 
     'changedStats' => ['costReserve'], 
];
  }
}
