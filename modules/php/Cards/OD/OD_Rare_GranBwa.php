<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_GranBwa extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_56_R2',
            'asset'  => 'ALT_BISE_B_MU_56_R',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Gran Bwa"),
            'typeline' => clienttranslate("Character - Deity"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Make an offering of Sap and spiced rum, and Gran Bwa will bless your orchard.'),
            'artist' => "Ba Vo",
			'extension'=>'WFTM',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('{J} You may have target opponent draw a card. If you do, I gain <ANCHORED>.  #When an opponent draws one or more cards or <RESUPPLIES> — I gain 1 boost.#'),
 				'supportDesc' => clienttranslate('{I} #When another Character joins your Expeditions# — I gain 1 boost, up to a max of 2.'),
 			     'supportIcon' => 'infinity',
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 4, 
     'costReserve' => 5, 
     'changedStats' => ['forest','mountain','ocean'], 
];
  }
}
