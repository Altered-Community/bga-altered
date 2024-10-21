<?php
namespace ALT\Cards\AX;

class AX_Rare_VaikeEnergyPioneer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_35_R1',
            'asset'  => 'ALT_ALIZE_B_AX_35_R',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Vaike, Energy Pioneer"),
            'typeline' => clienttranslate("Character - Engineer"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Energy and persistence conquer all things.'),
            'artist' => "Zero Wen",
			'extension'=>'TBF',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('You may play exhausted cards from your Reserve.  #{R} $<EXHAUSTED_RESUPPLY>.#'),
     'forest' => 1, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['forest'], 
];
  }
}
