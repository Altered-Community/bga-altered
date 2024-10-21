<?php
namespace ALT\Cards\BR;

class BR_Rare_TechnicalBoots extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_44_R1',
            'asset'  => 'ALT_ALIZE_B_BR_44_R',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Technical Boots"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('There\'s no luck, only preparation.'),
            'artist' => "Edward Chee & Seok Yeong",
			'extension'=>'TBF',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('#{R} $<RESUPPLY>.#  When my Expedition moves forward — Target Character in my Expedition loses <FLEETING_CHAR>.'),
     'costHand' => 1, 
     'costReserve' => 2, 
     'changedStats' => ['costReserve'], 
];
  }
}
